// SPDX-License-Identifier: MIT
pragma solidity 0.8.2;

import "@openzeppelin/contracts-upgradeable/security/PausableUpgradeable.sol";
import "@openzeppelin/contracts-upgradeable/utils/StringsUpgradeable.sol";

import "@openzeppelin/contracts-upgradeable/utils/CountersUpgradeable.sol";
import "@openzeppelin/contracts-upgradeable/security/ReentrancyGuardUpgradeable.sol";
import "@openzeppelin/contracts-upgradeable/token/ERC721/ERC721Upgradeable.sol";
import "@openzeppelin/contracts-upgradeable/token/ERC20/ERC20Upgradeable.sol";

import "@openzeppelin/contracts-upgradeable/proxy/utils/Initializable.sol";
import "@openzeppelin/contracts-upgradeable/access/OwnableUpgradeable.sol";
import "@openzeppelin/contracts-upgradeable/proxy/utils/UUPSUpgradeable.sol";

abstract contract ISparkSwapRouter {
    function getAmountsIn(uint amountOut, address[] calldata path) external view virtual returns (uint[] memory amounts);
    function getAmountsOut(uint amountIn, address[] calldata path) external view virtual returns (uint[] memory amounts);
}

abstract contract SparkSwapRouterInterface {
    function getAmountsIn(uint amountOut, address[] memory path) public view virtual returns (uint[] memory);
}

contract Marketplace is Initializable, OwnableUpgradeable, UUPSUpgradeable, ReentrancyGuardUpgradeable {
    using CountersUpgradeable for CountersUpgradeable.Counter;
    CountersUpgradeable.Counter _itemIds;
    CountersUpgradeable.Counter _itemsSold;

    address payable marketplaceOwner;
    address ownlyAddress;

    uint256 listingPrice;

    struct MarketItem {
        uint itemId;
        address nftContract;
        uint256 tokenId;
        address payable seller;
        address payable owner;
        uint256 price;
        string currency;
        uint discountPercentage;
        uint idToAddressList;
        uint256 listingPrice;
        bool cancelled;
    }

    mapping(address => address) nftFirstOwner;
    mapping(uint256 => MarketItem) idToMarketItem;
    mapping(uint256 => address[]) idToAddressList;
    mapping(uint256 => uint256) idToAddressListDiscountPercentage;
    mapping(uint256 => bool) idToAddressListIsOnlyAllowed;

    event MarketItemCreated (
        uint indexed itemId,
        address indexed nftContract,
        uint256 indexed tokenId,
        address seller,
        uint256 price,
        string currency,
        uint discountPercentage,
        uint idToAddressList,
        uint256 listingPrice
    );

    event MarketItemCancelled (
        uint indexed itemId
    );

    event MarketItemSold (
        uint indexed itemId
    );

    function initialize() initializer public {
        __Ownable_init();
        __UUPSUpgradeable_init();

        marketplaceOwner = payable(0x768532c218f4f4e6E4960ceeA7F5a7A947a1dd61);
//        marketplaceOwner = payable(0x672b733C5350034Ccbd265AA7636C3eBDDA2223B);
        listingPrice = 0;
    }

    function _authorizeUpgrade(address newImplementation) internal onlyOwner override {}

    function addNftFirstOwner(address _contractAddress, address _owner) public onlyOwner virtual {
        nftFirstOwner[_contractAddress] = _owner;
    }

    function getNftFirstOwner(address _contractAddress) public view virtual returns (address) {
        return nftFirstOwner[_contractAddress];
    }

    function getListingPrice() public view virtual returns (uint256) {
        return listingPrice;
    }

    function setListingPrice(uint256 _listingPrice) public onlyOwner virtual {
        listingPrice = _listingPrice;
    }

    function getMarketItem(uint256 itemId) public view virtual returns (MarketItem memory) {
        return idToMarketItem[itemId];
    }

    function createMarketItem(address nftContractAddress, uint256 tokenId, uint256 price, string memory currency, uint256 discountPercentage, uint256 _idToAddressList) public virtual payable nonReentrant {
        IERC721Upgradeable nftContract = IERC721Upgradeable(nftContractAddress);
        address nftOwner = nftContract.ownerOf(tokenId);
        bool isApprovedForAll = nftContract.isApprovedForAll(nftOwner, address(this));

        require(compareStrings(currency, "BNB") || compareStrings(currency, "OWN"), "Invalid price currency.");
        require(nftOwner == msg.sender, "You must be the owner of the token.");
        require(isApprovedForAll, "You must give permission for this marketplace to access your token.");
        require(price > 0, "Price must be at least 1 wei.");
        require(msg.value == listingPrice, "Value must be equal to listing price.");
        require(discountPercentage < 100, "Invalid discount percentage.");

        MarketItem memory marketItem = fetchMarketItem(nftContractAddress, tokenId);
        require(marketItem.itemId == 0, "Market item already exists.");

        _itemIds.increment();
        uint256 itemId = _itemIds.current();

        idToMarketItem[itemId] = MarketItem(
            itemId,
            nftContractAddress,
            tokenId,
            payable(msg.sender),
            payable(address(0)),
            price,
            currency,
            discountPercentage,
            _idToAddressList,
            listingPrice,
            false
        );

        emit MarketItemCreated(
            itemId,
            nftContractAddress,
            tokenId,
            msg.sender,
            price,
            currency,
            discountPercentage,
            _idToAddressList,
            listingPrice
        );
    }

    function createMarketSale(uint256 itemId, string memory currency) public virtual payable nonReentrant returns (uint) {
        MarketItem memory marketItem = idToMarketItem[itemId];

        require(marketItem.cancelled == false, "Market item is already cancelled.");
        require(marketItem.owner == address(0), "Market item is already sold.");
        require(compareStrings(currency, "BNB") || compareStrings(currency, "OWN"), "Invalid price currency.");

        if(getIdToAddressListIsOnlyAllowed(marketItem.idToAddressList)) {
            require(getIsInAddressList(marketItem.idToAddressList, msg.sender), "Only those in the whitelist can purchase.");
        }

        if(compareStrings(currency, "BNB") && compareStrings(marketItem.currency, "BNB")) {
            require(msg.value == marketItem.price, "Please submit the asking price in order to complete the purchase.");
            marketItem.seller.transfer(msg.value);
        } else if(compareStrings(currency, "OWN") && compareStrings(marketItem.currency, "OWN")) {
            IERC20Upgradeable ownlyContract = IERC20Upgradeable(ownlyAddress);

            uint totalDiscountPercentage = marketItem.discountPercentage + getAddressListDiscountPercentage(marketItem.idToAddressList, msg.sender);
            uint finalPrice = (marketItem.price * (100 - totalDiscountPercentage)) / 100;

            ownlyContract.transferFrom(msg.sender, marketItem.seller, finalPrice);
        } else if(compareStrings(currency, "OWN") && compareStrings(marketItem.currency, "BNB")) {
            //            ISparkSwapRouter pancakeSwapRouterContract = ISparkSwapRouter(0xeB98E6e5D34c94F56708133579abB8a6A2aC2F26);
            //
            //            address[] memory path = new address[](2);
            //            path[0] = ownlyAddress;
            //            path[1] = 0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c;
            //
            //            uint[] memory ownPrice = pancakeSwapRouterContract.getAmountsIn(marketItem.price, path);
            //            uint finalPrice = (ownPrice[0] * (100 - marketItem.discountPercentage)) / 100;

            uint finalPrice = (5000000000000000000000000 * (100 - marketItem.discountPercentage)) / 100;

            IERC20Upgradeable ownlyContract = IERC20Upgradeable(ownlyAddress);
            ownlyContract.transferFrom(msg.sender, marketItem.seller, finalPrice);
        } else if(compareStrings(currency, "BNB") && compareStrings(marketItem.currency, "OWN")) {
            //            ISparkSwapRouter pancakeSwapRouterContract = ISparkSwapRouter(0xeB98E6e5D34c94F56708133579abB8a6A2aC2F26);
            //
            //            address[] memory path = new address[](2);
            //            path[0] = ownlyAddress;
            //            path[1] = 0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c;
            //
            //            uint[] memory bnbPrice = pancakeSwapRouterContract.getAmountsOut(marketItem.price, path);
            //            uint price = bnbPrice[1];

            uint price = 100000000000000000;
            price = price - 3000000000000000;

            require(msg.value >= price, "Please submit the asking price in order to complete the purchase.");
            marketItem.seller.transfer(msg.value);
        }

        IERC721Upgradeable(marketItem.nftContract).transferFrom(marketItem.seller, msg.sender, marketItem.tokenId);
        idToMarketItem[itemId].owner = payable(msg.sender);
        _itemsSold.increment();

        if(marketItem.listingPrice > 0) {
            payable(marketplaceOwner).transfer(marketItem.listingPrice);
        }

        emit MarketItemSold(
            itemId
        );

        return 0;
    }

    function cancelMarketItem(uint256 itemId) public virtual nonReentrant {
        MarketItem memory marketItem = idToMarketItem[itemId];

        require(marketItem.seller == msg.sender, "You do not own this market item.");
        require(marketItem.cancelled == false, "Market item is already cancelled.");

        IERC721Upgradeable nftContract = IERC721Upgradeable(marketItem.nftContract);
        address nftOwner = nftContract.ownerOf(marketItem.tokenId);
        bool isApprovedForAll = nftContract.isApprovedForAll(nftOwner, address(this));

        require(marketItem.owner == address(0), "This market item is already sold.");
        require(nftOwner == marketItem.seller, "You must be the owner of the token.");
        require(isApprovedForAll, "You must give permission for this marketplace to access your token.");

        idToMarketItem[itemId].cancelled = true;

        if(idToMarketItem[itemId].listingPrice > 0) {
            payable(msg.sender).transfer(idToMarketItem[itemId].listingPrice);
        }

        emit MarketItemCancelled(
            itemId
        );
    }

    function unsoldMarketItemExists(address nftContractAddress, uint256 tokenId) internal view virtual returns (bool) {
        MarketItem[] memory items = fetchMarketItems();
        bool exists = false;

        for (uint i = 0; i < items.length; i++) {
            if(items[i].nftContract == nftContractAddress && items[i].tokenId == tokenId) {
                exists = true;
                break;
            }
        }

        return exists;
    }

    function fetchMarketItem(address nftContractAddress, uint256 tokenId) public view virtual returns (MarketItem memory) {
        uint itemCount = _itemIds.current();

        MarketItem memory item;

        for (uint i = 1; i <= itemCount; i++) {
            MarketItem memory marketItem = idToMarketItem[i];

            if (marketItem.nftContract == nftContractAddress && marketItem.tokenId == tokenId && marketItem.owner == address(0) && marketItem.cancelled == false) {
                IERC721Upgradeable nftContract = IERC721Upgradeable(marketItem.nftContract);
                address nftOwner = nftContract.ownerOf(marketItem.tokenId);
                bool isApprovedForAll = nftContract.isApprovedForAll(nftOwner, address(this));

                if (nftOwner == marketItem.seller && isApprovedForAll) {
                    item = marketItem;
                    break;
                }
            }
        }

        return item;
    }

    function fetchMarketItems() public view virtual returns (MarketItem[] memory) {
        uint itemCount = _itemIds.current();
        uint unsoldItemCount = _itemIds.current() - _itemsSold.current();
        uint currentIndex = 0;

        MarketItem[] memory items = new MarketItem[](unsoldItemCount);
        for (uint i = 0; i < itemCount; i++) {
            IERC721Upgradeable nftContract = IERC721Upgradeable(idToMarketItem[i + 1].nftContract);
            address nftOwner = nftContract.ownerOf(idToMarketItem[i + 1].tokenId);
            bool isApprovedForAll = nftContract.isApprovedForAll(nftOwner, address(this));

            if (idToMarketItem[i + 1].owner == address(0) && nftOwner == idToMarketItem[i + 1].seller && isApprovedForAll) {
                uint currentId = idToMarketItem[i + 1].itemId;
                MarketItem storage currentItem = idToMarketItem[currentId];
                items[currentIndex] = currentItem;
                currentIndex += 1;
            }
        }

        return items;
    }

    function fetchMyNFTs() public view virtual returns (MarketItem[] memory) {
        uint totalItemCount = _itemIds.current();
        uint itemCount = 0;
        uint currentIndex = 0;

        for (uint i = 0; i < totalItemCount; i++) {
            if (idToMarketItem[i + 1].owner == msg.sender) {
                itemCount += 1;
            }
        }

        MarketItem[] memory items = new MarketItem[](itemCount);
        for (uint i = 0; i < totalItemCount; i++) {
            if (idToMarketItem[i + 1].owner == msg.sender) {
                uint currentId = idToMarketItem[i + 1].itemId;
                MarketItem storage currentItem = idToMarketItem[currentId];
                items[currentIndex] = currentItem;
                currentIndex += 1;
            }
        }

        return items;
    }

    function compareStrings(string memory a, string memory b) public view virtual returns (bool) {
        return (keccak256(abi.encodePacked((a))) == keccak256(abi.encodePacked((b))));
    }

    function getOwnlyAddress() public view virtual returns (address) {
        return ownlyAddress;
    }

    function setOwnlyAddress(address _ownlyAddress) public onlyOwner virtual {
        ownlyAddress = _ownlyAddress;
    }

    function getIsInAddressList(uint id, address _user) public view returns (bool) {
        bool isInAddressList = false;

        for (uint i = 0; i < idToAddressList[id].length; i++) {
            if (idToAddressList[id][i] == _user) {
                isInAddressList = true;
                break;
            }
        }

        return isInAddressList;
    }

    function getAddressListDiscountPercentage(uint id, address _user) public view returns (uint) {
        uint discountPercentage = 0;

        for (uint i = 0; i < idToAddressList[id].length; i++) {
            if (idToAddressList[id][i] == _user) {
                discountPercentage = idToAddressListDiscountPercentage[id];
                break;
            }
        }

        return discountPercentage;
    }

    function addressList(uint id, address[] calldata _addresses, uint discountPercentage) public onlyOwner {
        delete idToAddressList[id];
        idToAddressList[id] = _addresses;

        idToAddressListDiscountPercentage[id] = discountPercentage;
    }

    function getIdToAddressListIsOnlyAllowed(uint id) public view returns (bool) {
        return idToAddressListIsOnlyAllowed[id];
    }

    function setIdToAddressListIsOnlyAllowed(uint id, bool state) public onlyOwner {
        idToAddressListIsOnlyAllowed[id] = state;
    }

    function version() pure public virtual returns (string memory) {
        return "v1";
    }
}
