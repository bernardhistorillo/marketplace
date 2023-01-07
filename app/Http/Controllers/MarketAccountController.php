<?php

namespace App\Http\Controllers;

use App\MarketAccount;
use App\TokenTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MarketAccountController extends Controller
{
    public function store_market_account(Request $request) {
        $request->validate([
            'address' => 'required',
            'signature' => 'required',
        ]);

        $market_account = MarketAccount::where('address', $request->address)
            ->where('signature', $request->signature)
            ->first();

        if(!$market_account) {
            $market_account = new MarketAccount;
            $market_account->address = $request->address;
            $market_account->signature = $request->signature;
            $market_account->save();
        }

        return response()->json([]);
    }

    public function store_account_settings(Request $request) {
        $request->validate([
            'address' => 'required',
            'signature' => 'required',
            'username' => 'required',
            'email_address' => 'required|email',
            'bio' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        $market_account = MarketAccount::where('address', $request->address)
            ->where('signature', $request->signature)
            ->first();

        $photo = null;

        if($request->file('photo')) {
            $photo = $request->file('photo');
            $name = 'image.' . $photo->getClientOriginalExtension();
            $photo = config('app.url') . '/storage/' . $request->file('photo')->storeAs('account_photos/' . $request->address, $name, 'public');
        }

        if(!$market_account) {
            $market_account = new MarketAccount;
            $market_account->address = $request->address;
            $market_account->signature = $request->signature;
            $market_account->name = $request->username;
            $market_account->email = $request->email_address;
            $market_account->bio = $request->bio;

            if($photo) {
                $market_account->photo = $photo;
            }

            $market_account->save();
        } else {
            $market_account->name = $request->username;
            $market_account->email = $request->email_address;
            $market_account->bio = $request->bio;

            if($photo) {
                $market_account->photo = $photo;
            }

            $market_account->update();
        }

        $market_account = MarketAccount::select('name', 'email', 'bio', 'photo')
            ->where('address', $request->address)
            ->first();

        return response()->json([
            'data' => $market_account
        ]);
    }

    public function get_account_settings(Request $request) {
        $request->validate([
            'address' => 'required',
        ]);

        $market_account = MarketAccount::select('name', 'email', 'bio', 'photo')
            ->where('address', $request->address)
            ->first();

        return response()->json([
            'data' => $market_account
        ]);
    }

    public function getBridgeSignature($chainId, $account) {
        $response = Http::get('http://ownly.market:8080/web3/bridge/getSignature/' . $chainId . '/' . $account);

        return $response;
    }
}
