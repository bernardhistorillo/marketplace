<?php

use App\BBMSignup;
use App\Collection;
use App\EmailSignup;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaunchpadController;
use App\Http\Controllers\MustachioRascalsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\TokenTransferController;
use App\Http\Controllers\TwitterController;
use App\Jobs\FetchTokenData;
use App\MarketItemFavorite;
use App\MustachioPathfinderMarauder;
use App\MustachioSubscriber;
use App\RewardsToken;
use App\Token;
use App\TokenTransfer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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

Route::prefix('elixir')->group(function () {
    Route::get('/', [BadgeController::class, 'index'])->name('elixir.index');

    Route::post('/check-twitter-account-follows/{twitter_id}', [BadgeController::class, 'checkTwitterAccountFollows'])->name('elixir.checkTwitterAccountFollows');
    Route::post('/validate-address', [BadgeController::class, 'validateAddress'])->name('elixir.validateAddress');
    Route::post('/claim', [BadgeController::class, 'claimElixir'])->name('elixir.claim');
});

// Email Signups
Route::get('emailsignupsvnvhlxgoosbjnwtalcpuiusbehrijevpnitmhmpxuichmcoqtugfagicfurlntoycipcjftcmrsgdnkxhjzuabwtyigdmdtlwkajkyftmuuqqiscmulsprntdjiwwxodaydyphoqgwnjrebasevnnciseejtdpqygliivxosgwngjowpfigcbkdwioycbohhnwdjmrrj', [HomeController::class, 'getEmailSignups'])->name('email.signup.get');
Route::get('amacph2022nuxwanfnnutcwnjptusecroqitalceuwvrachmullclafwkvjshvdgedyuohhuamzzbrcnbbufrdgkiuixoynljireewipboixgzsqsfbyjosdzqaqpkxbkjosnowsongauswnnoygqnptlzbexatpvtxqrlwklkoikvwrhwehwpijsitbthrtbkzudpwllzizszjhhk', [HomeController::class, 'getAmacRegistrants'])->name('amac.registrants.get');

Route::get('auth/twitter', [TwitterController::class, 'loginwithTwitter'])->name('auth.twitter');
Route::get('auth/callback/twitter', [TwitterController::class, 'cbTwitter']);

Route::get('/launchpad', [LaunchpadController::class, 'index'])->name('launchpad.index');
Route::get('/artists', [ArtistsController::class, 'index'])->name('artists.index');
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

Route::get('/model/mustachio/{tokenId}', [HomeController::class, 'mustachioModel'])->name('model.mustachio.index');
Route::get('/model/rascal/{tokenId}', [HomeController::class, 'rascalModel'])->name('model.rascal.index');
Route::get('/model/rascal/downloadFBX/{id}', [MustachioRascalsController::class, 'downloadFBX'])->name('model.rascal.downloadFBX');

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

Route::post('/amac-registrant-update-status', [HomeController::class, 'amacRegistrantUpdateStatus'])->name('amac.updateStatus');

Route::get('/{collection}/{tokenId}', [TokenController::class, 'index'])->name('token.index');
