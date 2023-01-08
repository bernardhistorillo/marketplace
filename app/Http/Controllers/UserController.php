<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function store_market_account(Request $request) {
        $request->validate([
            'address' => 'required',
            'signature' => 'required',
        ]);

        $user = User::where('address', $request->address)
            ->where('signature', $request->signature)
            ->first();

        if(!$user) {
            $user = new User();
            $user->address = $request->address;
            $user->signature = $request->signature;
            $user->save();
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

        $user = User::where('address', $request->address)
            ->where('signature', $request->signature)
            ->first();

        $photo = null;

        if($request->file('photo')) {
            $photo = $request->file('photo');
            $name = 'image.' . $photo->getClientOriginalExtension();
            $photo = config('app.url') . '/storage/' . $request->file('photo')->storeAs('account_photos/' . $request->address, $name, 'public');
        }

        if(!$user) {
            $user = new User();
            $user->address = $request->address;
            $user->signature = $request->signature;
            $user->name = $request->username;
            $user->email = $request->email_address;
            $user->bio = $request->bio;

            if($photo) {
                $user->photo = $photo;
            }

            $user->save();
        } else {
            $user->name = $request->username;
            $user->email = $request->email_address;
            $user->bio = $request->bio;

            if($photo) {
                $user->photo = $photo;
            }

            $user->update();
        }

        $user = User::select('name', 'email', 'bio', 'photo')
            ->where('address', $request->address)
            ->first();

        return response()->json([
            'data' => $user
        ]);
    }

    public function get_account_settings(Request $request) {
        $request->validate([
            'address' => 'required',
        ]);

        $user = User::select('name', 'email', 'bio', 'photo')
            ->where('address', $request->address)
            ->first();

        return response()->json([
            'data' => $user
        ]);
    }

    public function getBridgeSignature($chainId, $account) {
        $response = Http::get('http://ownly.market:8080/web3/bridge/getSignature/' . $chainId . '/' . $account);

        return $response;
    }
}
