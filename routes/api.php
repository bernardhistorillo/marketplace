<?php

use App\Http\Controllers\BBMController;
use App\Http\Controllers\ChenInkController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\GenesisBlockController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarketAccountController;
use App\Http\Controllers\MarketItemController;
use App\Http\Controllers\MarketItemFavoriteController;
use App\Http\Controllers\MustachioRascalsController;
use App\Http\Controllers\MustachioverseAssetsController;
use App\Http\Controllers\MustachioSubscriberController;
use App\Http\Controllers\MustachioController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OhaController;
use App\Http\Controllers\OwnedTokensController;
use App\Http\Controllers\OwnTokenController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\SagesRantCollectibleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StakingController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\TitansController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\TokenTransferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/store-market-account', [MarketAccountController::class, 'store_market_account']);
Route::post('/store-account-settings', [MarketAccountController::class, 'store_account_settings']);
Route::post('/get-account-settings', [MarketAccountController::class, 'get_account_settings']);

Route::post('/store-market-item-favorite', [MarketItemFavoriteController::class, 'store']);
Route::post('/get-market-item-favorites', [MarketItemFavoriteController::class, 'get_item']);
Route::post('/get-market-item-user-favorites', [MarketItemFavoriteController::class, 'get_user_favorites']);

Route::post('/store-mustachio-subscriber', [MustachioSubscriberController::class, 'store']);

Route::post('store-token-transaction', [TokenTransferController::class, 'storeTokenTransactions']);
Route::post('token_transfer/update_token_transaction', [TokenTransferController::class, 'updateTokenTransactionV2']);

Route::get('owned_tokens/{address}', [OwnedTokensController::class, 'getOwned']);

Route::get('search', [SearchController::class, 'search']);

Route::post('/add-staking-transactions', [StakingController::class, 'addStakingTransactions']);
Route::post('/update-staking-earnings', [StakingController::class, 'updateStakingEarnings']);
Route::get('/get-staking-top-earners/{staking}', [StakingController::class, 'getStakingTopEarners']);

Route::get('time-remaining', [TimerController::class, 'getSales']);

Route::post('/store-market-item', [MarketItemController::class, 'store']);
Route::get('/get-market-items/{chainId}', [MarketItemController::class, 'getMarketItems']);

Route::post('/store-token', [TokenController::class, 'store']);
Route::get('/get-tokens/{contractAddress}/{address?}', [TokenController::class, 'getTokens']);
Route::get('/get-tokens-paginate/{chainId}/{contractAddress}', [TokenController::class, 'getTokensPaginate']);
Route::get('/get-token/{address}/{contract_address}/{id}', [TokenController::class, 'getToken']);
Route::get('/get-mustachios/{address?}', [TokenController::class, 'getMustachios']);

Route::get('/get-collections', [CollectionController::class, 'getCollections']);
Route::get('/get-collection-properties/{id}', [CollectionController::class, 'getCollectionProperties']);
Route::get('/get-launchpad-collections/{address}', [CollectionController::class, 'getLaunchpadCollections']);
Route::post('/update-collection', [CollectionController::class, 'updateCollection']);
Route::get('/get-launchpad-collection-items/{collection_id}', [CollectionController::class, 'getLaunchpadCollectionItems']);
Route::post('/update-collection-item', [CollectionController::class, 'updateCollectionItem']);

Route::get('/web3/bridge/getSignature/{chainId}/{account}', [MarketAccountController::class, 'getBridgeSignature']);

Route::get('/quest/getQuestOneReward/{holder}/{tokenId}/{signature}', [QuestController::class, 'getQuestOneRewardTest']);

Route::post('/offer/makeOffer', [OfferController::class, 'makeOffer']);

Route::post('/bbm-signup', [BBMController::class, 'signup']);
Route::post('/email-signup', [HomeController::class, 'emailSignup']);

Route::post('/amac-register', [HomeController::class, 'amacRegister']);
Route::get('/amac-verified-registrants-count', [HomeController::class, 'amacVerifiedRegistrantsCount']);

Route::get('/rascals/{id}', [MustachioRascalsController::class, 'getMustachioRascal']);
Route::get('/rascals-prereveal/{id}', [MustachioRascalsController::class, 'getMustachioRascal']);
Route::get('/previous-rascals/{id}', [MustachioRascalsController::class, 'getPreviousMustachioRascal']);

Route::post('/rascals/store-minter', [MustachioRascalsController::class, 'storeMinter']);
