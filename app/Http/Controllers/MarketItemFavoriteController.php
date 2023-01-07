<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\GenesisBlockToken;
use App\MarketItemFavorite;
use App\Mustachio;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MarketItemFavoriteController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'address' => 'required',
            'contract_address' => 'required',
            'token_id' => 'required',
        ]);

        $market_item_favorite = MarketItemFavorite::where('address', $request->address)
            ->where('contract_address', $request->contract_address)
            ->where('token_id', $request->token_id)
            ->first();

        if(!$market_item_favorite) {
            $market_item_favorite = new MarketItemFavorite;
            $market_item_favorite->address = $request->address;
            $market_item_favorite->contract_address = $request->contract_address;
            $market_item_favorite->token_id = $request->token_id;
            $market_item_favorite->status = $request->status;
            $market_item_favorite->save();
        } else {
            $market_item_favorite->status = $request->status;
            $market_item_favorite->update();
        }

        return response()->json([
            'status' => $market_item_favorite['status']
        ]);
    }

    public function get_item(Request $request) {
        $request->validate([
            'address' => 'required',
            'contract_address' => 'required',
            'token_id' => 'required',
        ]);

        $total = MarketItemFavorite::where('contract_address', $request->contract_address)
            ->where('token_id', $request->token_id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $request->address)
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
            'address' => 'required'
        ]);

        $address = strtolower($request->address);

        $favorited_mustachio_tokens = Mustachio::select('mustachios.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash', 'market_item_favorites.contract_address')
            ->addSelect(DB::raw('"' . config('ownly.chain_id_eth') . '" as chain_id'))
            ->join('token_transfers', function($join) {
                $join->on('token_transfer_id', 'token_transfers.id');
            })
            ->join('market_item_favorites', function($join) use ($address) {
                $join->on('mustachios.id', 'market_item_favorites.token_id');
                $join->where('market_item_favorites.contract_address', config('ownly.contract_address_mustachios'));
                $join->where('market_item_favorites.address', $address);
            });

        $favorited_titans_tokens = TitansToken::select('titans_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash', 'market_item_favorites.contract_address')
            ->addSelect(DB::raw('"' . config('ownly.chain_id_bsc') . '" as chain_id'))
            ->join('token_transfers', function($join) {
                $join->on('token_transfer_id', 'token_transfers.id');
            })
            ->join('market_item_favorites', function($join) use ($address) {
                $join->on('titans_tokens.id', 'market_item_favorites.token_id');
                $join->where('market_item_favorites.contract_address', config('ownly.contract_address_mustachios'));
                $join->where('market_item_favorites.address', $address);
            });

        $favorited_chen_ink_tokens = ChenInkToken::select('chen_ink_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash', 'market_item_favorites.contract_address')
            ->addSelect(DB::raw('"' . config('ownly.chain_id_eth') . '" as chain_id'))
            ->join('token_transfers', function($join) {
                $join->on('token_transfer_id', 'token_transfers.id');
            })
            ->join('market_item_favorites', function($join) use ($address) {
                $join->on('chen_ink_tokens.id', 'market_item_favorites.token_id');
                $join->where('market_item_favorites.contract_address', config('ownly.contract_address_mustachios'));
                $join->where('market_item_favorites.address', $address);
            });

        $favorited_genesis_block_tokens = GenesisBlockToken::select('genesis_block_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash', 'market_item_favorites.contract_address')
            ->addSelect(DB::raw('"' . config('ownly.chain_id_eth') . '" as chain_id'))
            ->join('token_transfers', function($join) {
                $join->on('token_transfer_id', 'token_transfers.id');
            })
            ->join('market_item_favorites', function($join) use ($address) {
                $join->on('genesis_block_tokens.id', 'market_item_favorites.token_id');
                $join->where('market_item_favorites.contract_address', config('ownly.contract_address_mustachios'));
                $join->where('market_item_favorites.address', $address);
            });

        $favorited_rewards_tokens = RewardsToken::select('rewards_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash', 'market_item_favorites.contract_address')
            ->addSelect(DB::raw('"' . config('ownly.chain_id_matic') . '" as chain_id'))
            ->join('token_transfers', function($join) {
                $join->on('token_transfer_id', 'token_transfers.id');
            })
            ->join('market_item_favorites', function($join) use ($address) {
                $join->on('rewards_tokens.id', 'market_item_favorites.token_id');
                $join->where('market_item_favorites.contract_address', config('ownly.contract_address_mustachios'));
                $join->where('market_item_favorites.address', $address);
            });

        $favorited_sages_rant_collectibles = SagesRantCollectible::select('sages_rant_collectibles.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash', 'market_item_favorites.contract_address')
            ->addSelect(DB::raw('"' . config('ownly.chain_id_matic') . '" as chain_id'))
            ->join('token_transfers', function($join) {
                $join->on('token_transfer_id', 'token_transfers.id');
            })
            ->join('market_item_favorites', function($join) use ($address) {
                $join->on('sages_rant_collectibles.id', 'market_item_favorites.token_id');
                $join->where('market_item_favorites.contract_address', config('ownly.contract_address_mustachios'));
                $join->where('market_item_favorites.address', $address);
            });

        $favorited_tokens =  $favorited_mustachio_tokens->union($favorited_titans_tokens)
            ->union($favorited_chen_ink_tokens)
            ->union($favorited_genesis_block_tokens)
            ->union($favorited_genesis_block_tokens)
            ->union($favorited_rewards_tokens)
            ->union($favorited_sages_rant_collectibles)
            ->paginate(12);

        foreach($favorited_tokens as $favorited_token) {
            $favorited_token['favorite_count'] = MarketItemFavorite::where('contract_address', $favorited_token['contract_address'])
                ->where('token_id', $favorited_token['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $favorited_token['contract_address'])
                ->where('token_id', $favorited_token['id'])
                ->where('status', 1)
                ->first();

            $favorited_token['favorite_status'] = $status ? true : false;
        }

        return $favorited_tokens;
    }
}
