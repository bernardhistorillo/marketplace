<?php

namespace App\Http\Controllers;

use App\Token;
use App\TokenTransfer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $account = $request->account;
        $tab = $request->tab;
        $view = 'small-grid';

        $user = User::select('name', 'email', 'bio', 'photo')
            ->where('address', $account)
            ->first();

        if($tab == 'owned') {
            $tokens = $this->getOwnedTokens($request, $account);
        } else if($tab == 'favorites') {
            $tokens = $this->getFavoritedTokens($request, $account);
        } else {
            $tokens = [];
        }

        foreach($tokens as $token) {
            $token['collection'] = $token->collection();
        }

        return view('profile.index', compact('account', 'user', 'tab', 'view', 'tokens'));
    }

    public function getAccountContent(Request $request) {
        $account = $request->address;

        $user = User::select('name', 'email', 'bio', 'photo')
            ->where('address', 'LIKE', $account)
            ->first();

        $discountSignature = $this->checkAccountIfHasDiscount($account);

        return view('includes.profile.account', compact('account', 'user', 'discountSignature'));
    }

    public function save(Request $request) {
        $request->validate([
            'signature' => 'required',
            'username' => 'required',
            'email_address' => 'required|email',
            'bio' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        $user = User::where('address', $request->account)
            ->where('signature', $request->signature)
            ->first();

        $photo = null;

        if($request->file('photo')) {
            $photo = $request->file('photo');
            $name = 'image.' . $photo->getClientOriginalExtension();
            $photo = config('app.url') . '/storage/' . $request->file('photo')->storeAs('account_photos/' . $request->account, $name, 'public');
        }

        if(!$user) {
            $user = new User();
            $user->address = $request->account;
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

    public function getAccountSettings(Request $request) {
        $account = $request->account;
        $address = $request->address;

        $user = User::select('name', 'email', 'bio', 'photo')
            ->where('address', $account)
            ->first();

        return view('profile.account_settings', compact('account', 'address', 'user'));
    }

    public function getOwnedTokens(Request $request, $account) {
        $tokens = Token::select('tokens.id', 'tokens.token_id', 'collection_id', 'tokens.name', 'tokens.description', 'image', 'thumbnail', 'attributes', 'priority', 'to', 'transaction_hash', 'collections.contract_address', 'abi', 'collections.chain_id', 'supply', 'url')
            ->leftJoin('collections', 'collection_id', 'collections.id')
            ->join('token_transfers', function($join) use ($account) {
                $join->on('token_transfers.id', 'token_transfer_id');
                $join->where('to', 'LIKE', $account);
            });

        $rewardTokens = Token::select('tokens.id', 'tokens.token_id', 'collection_id', 'tokens.name', 'tokens.description', 'image', 'thumbnail', 'attributes', 'priority', 'to', 'transaction_hash', 'collections.contract_address', 'abi', 'collections.chain_id', 'supply', 'url')
            ->where('collection_id', 8)
            ->leftJoin('collections', 'collection_id', 'collections.id')
            ->join('token_transfers', function($join) use ($account) {
                $join->on('tokens.token_id', 'token_transfers.token_id');
                $join->where('token_transfers.contract_address', 'LIKE', config('ownly.contract_address_rewards'));
                $join->where('to', 'LIKE', $account);
                $join->where('is_current', 1);
            });

        return $tokens->unionAll($rewardTokens)
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(12);
    }

    public function getFavoritedTokens(Request $request, $account) {
        return Token::select('tokens.id', 'tokens.token_id', 'collection_id', 'tokens.name', 'tokens.description', 'image', 'thumbnail', 'attributes', 'priority', 'collections.contract_address', 'abi', 'collections.chain_id', 'supply', 'url')
            ->leftJoin('collections', 'collection_id', 'collections.id')
            ->join('favorites', function($join) use ($account) {
                $join->on('collections.contract_address', 'LIKE', 'favorites.contract_address');
                $join->on('tokens.token_id', 'token_id');
                $join->on('tokens.token_id', 'token_id');
                $join->where('address', 'LIKE', $account);
                $join->where('status', 1);
            })
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(12);
    }

    public function checkAccountIfHasDiscount($address) {
        $holdings = Http::post(config('ownly.nodejs_url') . '/web3/tokenHolderDiscount/getSignature', [
            'address' => strtolower($address),
            'key' => config('ownly.api_key')
        ]);

        $ownTokenBalance = $holdings['ownTokenBalance'];
        $hasOwnlyNFT = false;

        if($ownTokenBalance < 1000000) {
            $signature = null;

            $tokenTransfers = TokenTransfer::where('to', 'LIKE', $address)
                ->where('is_current', 1)
                ->get();

            foreach($tokenTransfers as $tokenTransfer) {
                $token = $tokenTransfer->token();
                $owner = $token->owner();

                if(strtolower($owner) == strtolower($tokenTransfer['to'])) {
                    $hasOwnlyNFT = true;
//                    $signature = $signature['signature'];
                    $signature = null;
                    break;
                } else {
                    $token->updateTokenTransaction();
                }
            }
        } else {
            $signature = $holdings['signature'];
        }

        return [
            'ownTokenBalance' => $ownTokenBalance,
            'hasOwnlyNFT' => $hasOwnlyNFT,
            'signature' => $signature
        ];
    }
}
