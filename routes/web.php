<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Test
Route::get('tryzrvmhyuoxsddhzinrmfmmcjunhckutcctrpfonpxkclssaadggoyubbswcfdsivgwdgruzzanlaggwrh', [TestController::class, 'try']);

// Logs
Route::get('logsrkudcblhvzmjhvueujvxyecashzlglbonxekptmqemildfiawxxqwhwwdmnk', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/{collection}', [CollectionController::class, 'index'])->name('collection.index');
Route::post('/collection/getTokens/{collection}', [CollectionController::class, 'getTokens'])->name('collection.getTokens');
Route::post('/collection/updateViewOption', [CollectionController::class, 'updateViewOption'])->name('collection.updateViewOption');

Route::prefix('profile')->group(function () {
    Route::get('/{account}/{tab?}', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/save/{account}', [ProfileController::class, 'save'])->name('profile.save');
    Route::post('/getAccountSettings/{account}', [ProfileController::class, 'getAccountSettings'])->name('profile.getAccountSettings');
    Route::post('/getAccountContent', [ProfileController::class, 'getAccountContent'])->name('profile.getAccountContent');
});

Route::post('/token/getTokenActionButtons', [TokenController::class, 'getTokenActionButtons'])->name('token.getTokenActionButtons');
Route::post('/token/updateFavoriteStatus', [TokenController::class, 'updateFavoriteStatus'])->name('token.updateFavoriteStatus');
Route::post('/token/search', [TokenController::class, 'search'])->name('token.search');

Route::get('/{collection}/{tokenId}', [TokenController::class, 'index'])->name('token.index');
