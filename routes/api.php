<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MustachioSubscriberController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
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

Route::post('/store-mustachio-subscriber', [MustachioSubscriberController::class, 'store']);

Route::get('search', [SearchController::class, 'search']);

Route::post('/store-token', [TokenController::class, 'store']);
Route::get('/get-tokens/{contractAddress}/{address?}', [TokenController::class, 'getTokens']);
Route::get('/get-tokens-paginate/{chainId}/{contractAddress}', [TokenController::class, 'getTokensPaginate']);
Route::get('/get-token/{address}/{contract_address}/{id}', [TokenController::class, 'getToken']);
Route::get('/get-mustachios/{address?}', [TokenController::class, 'getMustachios']);

Route::get('/get-collections', [CollectionController::class, 'getCollections']);
Route::get('/get-collection-properties/{id}', [CollectionController::class, 'getCollectionProperties']);
Route::post('/update-collection', [CollectionController::class, 'updateCollection']);
Route::post('/update-collection-item', [CollectionController::class, 'updateCollectionItem']);

Route::get('/web3/bridge/getSignature/{chainId}/{account}', [UserController::class, 'getBridgeSignature']);
Route::post('/email-signup', [HomeController::class, 'emailSignup']);
