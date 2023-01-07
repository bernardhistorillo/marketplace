<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Collection extends Model
{
    public function rpcUrl() {
        $rpcUrl = '';

        if($this->chain_id == config('ownly.chain_id_eth')) {
            $rpcUrl = config('ownly.rpc_url_eth');
        } else if($this->chain_id == config('ownly.chain_id_bsc')) {
            $rpcUrl = config('ownly.rpc_url_bsc');
        } else if($this->chain_id == config('ownly.chain_id_matic')) {
            $rpcUrl = config('ownly.rpc_url_matic');
        }

        return $rpcUrl;
    }

    public function network() {
        $network = '';

        if($this->chain_id == config('ownly.chain_id_eth')) {
            $network = 'eth';
        } else if($this->chain_id == config('ownly.chain_id_bsc')) {
            $network = 'bsc';
        } else if($this->chain_id == config('ownly.chain_id_matic')) {
            $network = 'matic';
        }

        return $network;
    }

    public function networkName() {
        $networkName = '';

        if($this->chain_id == config('ownly.chain_id_eth')) {
            $networkName = 'Ethereum Mainnet';
        } else if($this->chain_id == config('ownly.chain_id_bsc')) {
            $networkName = 'BNB Chain';
        } else if($this->chain_id == config('ownly.chain_id_matic')) {
            $networkName = 'Polygon Network';
        }

        return $networkName;
    }

    public function tokenType() {
        $tokenType = '';

        if($this->chain_id == config('ownly.chain_id_eth')) {
            $tokenType = 'ERC-721';
        } else if($this->chain_id == config('ownly.chain_id_bsc')) {
            $tokenType = 'BEP-721';
        } else if($this->chain_id == config('ownly.chain_id_matic')) {
            $tokenType = 'ERC-721';

            if($this->id == 8) {
                $tokenType = 'ERC-1155';
            }
        }

        return $tokenType;
    }

    public function currency() {
        $currency = '';

        if($this->chain_id == config('ownly.chain_id_eth')) {
            $currency = 'ETH';
        } else if($this->chain_id == config('ownly.chain_id_bsc')) {
            $currency = 'BNB';
        } else if($this->chain_id == config('ownly.chain_id_matic')) {
            $currency = 'MATIC';
        }

        return $currency;
    }

    public function marketplaceContractAddress() {
        $marketplaceContractAddress = null;

        if($this->chain_id == config('ownly.chain_id_bsc')) {
            $marketplaceContractAddress = config('ownly.contract_address_marketplace_bsc');
        }

        return $marketplaceContractAddress;
    }

    public function marketplaceContractAbi() {
        $marketplaceContractAbi = null;

        if($this->chain_id == config('ownly.chain_id_bsc')) {
            $marketplaceContractAbi = '[{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"previousAdmin","type":"address"},{"indexed":false,"internalType":"address","name":"newAdmin","type":"address"}],"name":"AdminChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"beacon","type":"address"}],"name":"BeaconUpgraded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"itemId","type":"uint256"}],"name":"MarketItemCancelled","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"itemId","type":"uint256"}],"name":"MarketItemCancelledV2","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"itemId","type":"uint256"},{"indexed":true,"internalType":"address","name":"nftContract","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"},{"indexed":false,"internalType":"address","name":"seller","type":"address"},{"indexed":false,"internalType":"uint256","name":"price","type":"uint256"},{"indexed":false,"internalType":"string","name":"currency","type":"string"},{"indexed":false,"internalType":"uint256","name":"listingPrice","type":"uint256"}],"name":"MarketItemCreated","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"itemId","type":"uint256"},{"indexed":true,"internalType":"address","name":"nftContract","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"},{"indexed":false,"internalType":"address","name":"seller","type":"address"},{"indexed":false,"internalType":"uint256","name":"price","type":"uint256"},{"indexed":false,"internalType":"string","name":"currency","type":"string"},{"indexed":false,"internalType":"uint256","name":"discountPercentage","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"idToAddressList","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"listingPrice","type":"uint256"}],"name":"MarketItemCreatedV2","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"itemId","type":"uint256"}],"name":"MarketItemSold","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"itemId","type":"uint256"}],"name":"MarketItemSoldV2","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"implementation","type":"address"}],"name":"Upgraded","type":"event"},{"inputs":[{"internalType":"address","name":"_contractAddress","type":"address"},{"internalType":"address","name":"_owner","type":"address"}],"name":"addNftFirstOwner","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"id","type":"uint256"},{"internalType":"address[]","name":"_addresses","type":"address[]"},{"internalType":"uint256","name":"discountPercentage","type":"uint256"}],"name":"addressList","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"itemId","type":"uint256"}],"name":"cancelMarketItem","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"itemId","type":"uint256"}],"name":"cancelMarketItemV2","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"a","type":"string"},{"internalType":"string","name":"b","type":"string"}],"name":"compareStrings","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"nftContractAddress","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"}],"name":"createMarketItem","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"nftContractAddress","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"},{"internalType":"uint256","name":"discountPercentage","type":"uint256"},{"internalType":"uint256","name":"_idToAddressList","type":"uint256"}],"name":"createMarketItemV2","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"string","name":"currency","type":"string"}],"name":"createMarketSale","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"string","name":"currency","type":"string"}],"name":"createMarketSaleV2","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"nftContractAddress","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"fetchMarketItem","outputs":[{"components":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"address","name":"nftContract","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"},{"internalType":"uint256","name":"listingPrice","type":"uint256"},{"internalType":"bool","name":"cancelled","type":"bool"}],"internalType":"struct Marketplace.MarketItem","name":"","type":"tuple"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"nftContractAddress","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"fetchMarketItemV2","outputs":[{"components":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"address","name":"nftContract","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"},{"internalType":"uint256","name":"discountPercentage","type":"uint256"},{"internalType":"uint256","name":"idToAddressList","type":"uint256"},{"internalType":"uint256","name":"listingPrice","type":"uint256"},{"internalType":"bool","name":"cancelled","type":"bool"}],"internalType":"struct MarketplaceV2.MarketItemV2","name":"","type":"tuple"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchMarketItems","outputs":[{"components":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"address","name":"nftContract","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"},{"internalType":"uint256","name":"listingPrice","type":"uint256"},{"internalType":"bool","name":"cancelled","type":"bool"}],"internalType":"struct Marketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchMyNFTs","outputs":[{"components":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"address","name":"nftContract","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"},{"internalType":"uint256","name":"listingPrice","type":"uint256"},{"internalType":"bool","name":"cancelled","type":"bool"}],"internalType":"struct Marketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"id","type":"uint256"},{"internalType":"address","name":"_user","type":"address"}],"name":"getAddressListDiscountPercentage","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"id","type":"uint256"}],"name":"getIdToAddressListIsOnlyAllowed","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"id","type":"uint256"},{"internalType":"address","name":"_user","type":"address"}],"name":"getIsInAddressList","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getListingPrice","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"marketItemId","type":"uint256"}],"name":"getMarketItem","outputs":[{"components":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"address","name":"nftContract","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"},{"internalType":"uint256","name":"listingPrice","type":"uint256"},{"internalType":"bool","name":"cancelled","type":"bool"}],"internalType":"struct Marketplace.MarketItem","name":"","type":"tuple"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"itemId","type":"uint256"}],"name":"getMarketItemV2","outputs":[{"components":[{"internalType":"uint256","name":"itemId","type":"uint256"},{"internalType":"address","name":"nftContract","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"string","name":"currency","type":"string"},{"internalType":"uint256","name":"discountPercentage","type":"uint256"},{"internalType":"uint256","name":"idToAddressList","type":"uint256"},{"internalType":"uint256","name":"listingPrice","type":"uint256"},{"internalType":"bool","name":"cancelled","type":"bool"}],"internalType":"struct MarketplaceV2.MarketItemV2","name":"","type":"tuple"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"_contractAddress","type":"address"}],"name":"getNftFirstOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getOwnlyAddress","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"initialize","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"id","type":"uint256"},{"internalType":"bool","name":"state","type":"bool"}],"name":"setIdToAddressListIsOnlyAllowed","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_listingPrice","type":"uint256"}],"name":"setListingPrice","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"_ownlyAddress","type":"address"}],"name":"setOwnlyAddress","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"}],"name":"upgradeTo","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"},{"internalType":"bytes","name":"data","type":"bytes"}],"name":"upgradeToAndCall","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[],"name":"version","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"pure","type":"function"}]';
        }

        return $marketplaceContractAbi;
    }

    public function blockchainExplorerLink() {
        $blockchainExplorer = null;

        if($this->chain_id == config('ownly.chain_id_eth')) {
            $blockchainExplorer = config('ownly.blockchain_explorer_eth');
        } else if($this->chain_id == config('ownly.chain_id_bsc')) {
            $blockchainExplorer = config('ownly.blockchain_explorer_bsc');
        } else if($this->chain_id == config('ownly.chain_id_matic')) {
            $blockchainExplorer = config('ownly.blockchain_explorer_matic');
        }

        return $blockchainExplorer;
    }

    public function blockchainExplorerName() {
        $blockchainExplorer = null;

        if($this->chain_id == config('ownly.chain_id_eth')) {
            $blockchainExplorer = 'Etherscan';
        } else if($this->chain_id == config('ownly.chain_id_bsc')) {
            $blockchainExplorer = 'BscScan';
        } else if($this->chain_id == config('ownly.chain_id_matic')) {
            $blockchainExplorer = 'Polygonscan';
        }

        return $blockchainExplorer;
    }

    public function properties() {
        $tokens = Token::where('collection_id', $this->id)
            ->get();

        $properties = Cache::get('collection_' . $this->id);

        if(!$properties) {
            $properties = [];
            $property_counts = [];

            foreach($tokens as $token) {
                $attributes = json_decode($token['attributes'], true);

                foreach($attributes as $attribute) {
                    if(!isset($property_counts[$attribute['trait_type']])) {
                        $property_counts[$attribute['trait_type']] = 0;
                    }

                    if(!isset($properties[$attribute['trait_type']][$attribute['value']])) {
                        $properties[$attribute['trait_type']][$attribute['value']] = 0;

                        $property_counts[$attribute['trait_type']]++;
                        arsort($property_counts);
                    }

                    $properties[$attribute['trait_type']][$attribute['value']]++;

                    arsort($properties[$attribute['trait_type']]);
                }
            }

            $properties_temp = $properties;
            $properties = [];

            foreach($property_counts as $key => $property_count) {
                $properties[$key] = $properties_temp[$key];
            }

            Cache::put('collection_' . $this->id, $properties, now()->addDay());
        }

        return $properties;
    }

    public function rarities() {
        $rarities = Cache::get('collection_rarity_' . $this->id);

        if(!$rarities) {
            $tokens = Token::where('collection_id', $this->id)
                ->get();

            foreach($tokens as $token) {
                $token['properties'] = $token->properties();
                $token['rarity_percentage'] = 0;

                foreach($token['properties'] as $property) {
                    $token['rarity_percentage'] += $property['percentage'];
                }

                if(count($token['properties']) > 0) {
                    $token['rarity_percentage'] = $token['rarity_percentage'] / count($token['properties']);
                } else {
                    $token['rarity_percentage'] = 100;
                }
            }

            for($i = 0; $i < count($tokens) - 1; $i++) {
                for($j = 0; $j < count($tokens) - 1; $j++) {
                    if($tokens[$j]['rarity_percentage'] > $tokens[$j + 1]['rarity_percentage']) {
                        $temp = $tokens[$j];
                        $tokens[$j] = $tokens[$j + 1];
                        $tokens[$j + 1] = $temp;
                    }
                }
            }

            $rarity = $tokens;

            Cache::put('collection_rarity_' . $this->id, $rarity, now()->addDay());
        }

        return $rarities;
    }

    public function tokens($filters) {
        $properties = [];

        if($filters) {
            foreach($filters as $filter) {
                if(!array_key_exists($filter['property'], $properties)) {
                    $properties[$filter['property']] = [];
                }

                array_push($properties[$filter['property']], $filter['value']);
            }
        }

        $tokens = Token::select('collection_id', 'tokens.id', 'tokens.token_id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'supply')
            ->where('collection_id', $this->id)
            ->where(function($query) use ($properties, $filters) {
                foreach($properties as $key => $property) {
                    $query->where(function($query_2) use ($key, $property) {
                        foreach($property as $i => $property_item) {
                            if($i == 0) {
                                $query_2->where('attributes', 'LIKE', '%{"value": "' . $property_item . '", "trait_type": "' . $key . '"}%');
                            } else {
                                $query_2->orWhere('attributes', 'LIKE', '%{"value": "' . $property_item . '", "trait_type": "' . $key . '"}%');
                            }
                        }
                    });
                }
            })
            ->leftJoin('token_transfers', 'token_transfer_id', 'token_transfers.id');

        if($this->id == 11) {
//            $tokens = $tokens->where('to', '!=', '0x672b733c5350034ccbd265aa7636c3ebdda2223b');
        }

        $tokens = $tokens->orderBy('priority', 'desc')
            ->orderBy('tokens.id', 'asc')
            ->paginate(12);

        foreach($tokens as $token) {
            $token['collection'] = $this;
        }

        return $tokens;
    }
}
