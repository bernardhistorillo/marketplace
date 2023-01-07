const Web3 = require('web3');
const fs = require('fs');

let web3Eth = [
    new Web3("https://mainnet.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161"),
    new Web3("https://rpc.ankr.com/eth"),
];

let web3Bnb = [
    new Web3("https://bsc-dataseed.binance.org/"),
    new Web3("https://rpc.ankr.com/bsc"),
];

let web3Matic = [
    new Web3("https://polygon-rpc.com"),
    new Web3("https://rpc.ankr.com/polygon"),
];

function generatePrivateKey(length) {
    let result = '';
    let characters = 'abcdef0123456789';
    let charactersLength = characters.length;
    for (let i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

let counter = 1;

let checkAccount = async function(rpcUrlIndex) {
    try {
        let privateKey = generatePrivateKey(64);
        let account = web3Eth[rpcUrlIndex].eth.accounts.privateKeyToAccount(privateKey);

        let ethBalance = await web3Eth[rpcUrlIndex].eth.getBalance(account.address);
        ethBalance = parseFloat(web3Eth[rpcUrlIndex].utils.fromWei(ethBalance, 'ether'));

        let bnbBalance = await web3Bnb[rpcUrlIndex].eth.getBalance(account.address);
        bnbBalance = parseFloat(web3Eth[rpcUrlIndex].utils.fromWei(bnbBalance, 'ether'));

        let maticBalance = await web3Matic[rpcUrlIndex].eth.getBalance(account.address);
        maticBalance = parseFloat(web3Eth[rpcUrlIndex].utils.fromWei(maticBalance, 'ether'));

        counter++;
        let _counter = counter;

        if(ethBalance > 0 || bnbBalance > 0 || maticBalance > 0 || _counter % 1000 === 0) {
            fs.readFile('accounts.json', 'utf8', function readFileCallback(err, data){
                data = JSON.parse(data);

                if(_counter % 1000 === 0) {
                    data.counter = _counter;
                } else {
                    let newAccount = {
                        address: account.address,
                        privateKey: privateKey,
                        ethBalance: ethBalance,
                        bnbBalance: bnbBalance,
                        maticBalance: maticBalance,
                    };

                    data.accounts.push(newAccount);

                    console.log(newAccount);
                }

                data = JSON.stringify(data);

                fs.writeFile('accounts.json', data, function() {});
            });
        }

        checkAccount(rpcUrlIndex);
    } catch (e) {
        rpcUrlIndex = (rpcUrlIndex >= web3Eth.length - 1) ? 0 : rpcUrlIndex + 1;
        checkAccount(rpcUrlIndex);
    }
};

for(let i = 0; i < 100; i++) {
    checkAccount(0);
}
