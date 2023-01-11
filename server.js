const Web3 = require('web3');
const express = require('express')
const fs = require('fs');
const axios = require('axios');
const app = express()
const keccak256 = require('keccak256')
const port = 8080
const HDWalletProvider = require('@truffle/hdwallet-provider')

require('dotenv').config();

// let web3 = new Web3(process.env.RPC_URL_ETH);
let web3 = [];
let contracts = [];

const web3Bsc = new Web3(process.env.RPC_URL_BSC);
const web3Eth = new Web3(process.env.RPC_URL_ETH);

let ownTokenContractAbi = [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burnFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"}];
let ownTokenContract = new web3Bsc.eth.Contract(
    ownTokenContractAbi,
    "0x7665CB7b0d01Df1c9f9B9cC66019F00aBD6959bA"
)

// let mainBridgeContractAbi = JSON.parse(fs.readFileSync('./resources/json/MainBridge.json'));
// let wrappedOwnlyContractAbi = JSON.parse(fs.readFileSync('./resources/json/WrappedOwnly.json'));
//
// const mainBridge = new web3Bsc.eth.Contract(
//     mainBridgeContractAbi,
//     process.env.MAIN_BRIDGE
// );
//
// const wrappedOwnly = new web3Eth.eth.Contract(
//     wrappedOwnlyContractAbi,
//     process.env.WRAPPED_OWNLY
// );

let getWeb3 = function(rpcUrl) {
    let _web3 = null;

    for(let i = 0; i < web3.length; i++) {
        if(web3[i].rpcUrl === rpcUrl) {
            _web3 = web3[i];
            break;
        }
    }

    if(!_web3) {
        _web3 = {
            rpcUrl: rpcUrl,
            web3: new Web3(rpcUrl)
        };

        web3.push(_web3);
    }

    return _web3.web3;
};

let getContract = function(web3, contractAddress, abi) {
    let contract = null;

    for(let i = 0; i < contracts.length; i++) {
        if(contracts[i].web3 === web3 && contracts[i].contractAddress === contractAddress && contracts[i].abi === abi) {
            contract = contracts[i];
            break;
        }
    }

    if(!contract) {
        contract = {
            web3: web3,
            contractAddress: contractAddress,
            abi: abi,
            contract: new web3.eth.Contract(
                JSON.parse(abi),
                contractAddress
            )
        };

        contracts.push(contract);
    }

    return contract.contract;
};

app.listen(port, () => {
    console.log("Listening");
})

app.use(express.json())

app.get('/', (req, res) => {
    res.send({
        data: "Hello World"
    });
});

app.get('/web3/isAddress/:address', (req, res) => {
    let data = {
        isAddress: web3.utils.isAddress(req.params.address)
    };

    res.send(data);
});

app.get('/web3/getTokenURI/:chainId/:contractAddress/:tokenId', (req, res) => {
    let explorers = {
        '1': {
            endpoint: 'https://api.etherscan.io',
            key: process.env.EXPLORER_API_KEY_ETH,
            rpc: process.env.RPC_URL_ETH,
        },
        '56': {
            endpoint: 'https://api.bscscan.com',
            key: process.env.EXPLORER_API_KEY_BSC,
            rpc: process.env.RPC_URL_BSC,
        },
        '136': {
            endpoint: 'https://api.polygonscan.com',
            key: process.env.EXPLORER_API_KEY_MATIC,
            rpc: process.env.RPC_URL_MATIC,
        }
    };

    try {
        axios.get(explorers[req.params.chainId].endpoint + '/api?module=contract&action=getabi&address=' + req.params.contractAddress + '&apikey=' + explorers[req.params.chainId].key)
            .then(data => {
                let contractAbi = data.data.result;
                let web3 = new Web3(explorers[req.params.chainId].rpc);
                let contract = new web3.eth.Contract(JSON.parse(contractAbi), req.params.contractAddress);

                contract.methods.tokenURI(req.params.tokenId).call()
                    .then(function(data) {
                        data = data.replace('ipfs.io', 'gateway.pinata.cloud');

                        axios.get(data)
                            .then(data => {
                                if(data.data) {
                                    axios.post(process.env.OWNLY_URL + "/api/store-token", {
                                        chainId: req.params.chainId,
                                        contractAddress: req.params.contractAddress,
                                        tokenId: req.params.tokenId,
                                        metadata: JSON.stringify(data.data),
                                        apiKey: process.env.API_KEY
                                    }).then(data => {
                                        res.send(data.data);
                                    }).catch(err => res.send(err));
                                }
                            }).catch(err => res.send(err));
                    }).catch(err => res.send(err));
            })
            .catch(err => res.send(err));
    } catch(err){
        console.error(err);
    }
});

// Marketplace
app.post('/web3/getTokenOwner', async (req, res) => {
    try {
        if(process.env.API_KEY !== req.body.key) {
            res.send({
                owner: "0x672b733C5350034Ccbd265AA7636C3eBDDA2223B"
            });
        }

        let _web3 = getWeb3(req.body.rpcUrl);
        let owner = null;

        let tokenContract = getContract(_web3, req.body.contractAddress, req.body.abi)

        await tokenContract.methods.ownerOf(req.body.tokenId).call()
            .then(async function(_owner) {
                owner = _owner;
            });

        res.send({
            owner: owner
        });
    } catch(e) {
        res.send({
            owner: "0x672b733C5350034Ccbd265AA7636C3eBDDA2223B"
        });
    }
});

app.post('/web3/getMarketItem', async (req, res) => {
    try {
        if(process.env.API_KEY !== req.body.key) {
            res.send({
                marketItem: null
            });
        }

        let _web3 = getWeb3(req.body.rpcUrl);
        let marketItem = null;

        let marketplaceContract = getContract(_web3, req.body.marketplaceContractAddress, req.body.abi)

        await marketplaceContract.methods.fetchMarketItem(req.body.contractAddress, req.body.tokenId).call()
            .then(async function(_marketItem) {
                marketItem = _marketItem;
            });

        await marketplaceContract.methods.fetchMarketItem(req.body.contractAddress, req.body.tokenId).call()
            .then(async function(_marketItem) {
                marketItem = _marketItem;
            });

        res.send({
            marketItem: {
                itemId: marketItem.itemId,
                nftContract: marketItem.nftContract,
                tokenId: marketItem.tokenId,
                seller: marketItem.seller,
                owner: marketItem.owner,
                price: marketItem.price,
                priceInEther: _web3.utils.fromWei(marketItem.price, "ether"),
                currency: marketItem.currency,
                discountPercentage: marketItem.discountPercentage,
                idToAddressList: marketItem.idToAddressList,
                listingPrice: marketItem.listingPrice,
                cancelled: marketItem.cancelled,
            }
        });
    } catch(e) {
        res.send({
            marketItem: null
        });
    }
});

app.post('/web3/tokenHolderDiscount/getSignature', async (req, res) => {
    try {
        if(process.env.API_KEY !== req.body.key) {
            res.send({
                signature: null,
                ownTokenBalance: 0
            });
        }

        let ownTokenBalance = 0;
        await ownTokenContract.methods.balanceOf(req.body.address).call()
            .then(async function(balance) {
                ownTokenBalance = balance;
            });

        let messageHash = keccak256(new Web3().utils.toChecksumAddress(req.body.address)).toString('hex');
        let signatureObject = new Web3().eth.accounts.sign(messageHash, process.env.VALIDATOR);

        res.send({
            signature: signatureObject.signature,
            ownTokenBalance: Web3.utils.fromWei(ownTokenBalance, 'ether')
        });
    } catch(e) {
        res.send({
            signature: null,
            ownTokenBalance: 0
        });
    }
});

// Elixir
app.post('/web3/getSigningAddress', (req, res) => {
    if(process.env.API_KEY !== req.body.key) {
        return 0;
    }

    let signingAddress = new Web3().eth.accounts.recover(req.body.message, req.body.signature);

    res.send({
        signingAddress: signingAddress
    });
});
