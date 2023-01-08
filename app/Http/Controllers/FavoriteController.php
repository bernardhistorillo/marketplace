<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\GenesisBlockToken;
use App\Favorite;
use App\Mustachio;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use App\Token;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'token_id' => 'required',
        ]);

        $marketItemFavorite = Favorite::where('user_id', $request->user_id)
            ->where('token_id', $request->token_id)
            ->first();

        if(!$marketItemFavorite) {
            $marketItemFavorite = new Favorite;
            $marketItemFavorite->user_id = $request->user_id;
            $marketItemFavorite->token_id = $request->token_id;
            $marketItemFavorite->status = $request->status;
            $marketItemFavorite->save();
        } else {
            $marketItemFavorite->status = $request->status;
            $marketItemFavorite->update();
        }

        return response()->json([
            'status' => $marketItemFavorite['status']
        ]);
    }

    public function get_item(Request $request) {
        $request->validate([
            'address' => 'required',
            'contract_address' => 'required',
            'token_id' => 'required',
        ]);

        $total = Favorite::where('contract_address', $request->contract_address)
            ->where('token_id', $request->token_id)
            ->where('status', 1)
            ->count();

        $status = Favorite::where('address', $request->address)
            ->where('contract_address', $request->contract_address)
            ->where('token_id', $request->token_id)
            ->where('status', 1)
            ->first();

        return response()->json([
            'total' => $total,
            'status' => ($status) ? true : false
        ]);
    }

    public function get_user_favorites(Request $request) {
        $request->validate([
            'user_id' => 'required'
        ]);

        $user = User::find($request->user_id);

        $favorites = Token::select('token_id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->join('token_transfers', function($join) {
                $join->on('token_transfer_id', 'token_transfers.id');
            })
            ->join('favorites', function($join) use ($user) {
                $join->on('tokens.id', 'favorites.token_id');
                $join->where('favorites.user_id', $user['id']);
            })
            ->paginate(12);

        foreach($favorites as $favorite) {
            $favorite['count'] = Favorite::where('token_id', $favorite['token_id'])
                ->where('status', 1)
                ->count();

            $status = Favorite::where('user_id', $user['id'])
                ->where('token_id', $favorite['token_id'])
                ->where('status', 1)
                ->first();

            $favorite['status'] = (bool)$status;
        }

        return $favorites;
    }
}
