<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\Collection;
use App\GenesisBlockToken;
use App\Favorite;
use App\Mustachio;
use App\MustachioPathfinderMarauder;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use App\Token;
use App\TokenTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OwnedTokensController extends Controller
{
    public function getOwned($address) {
        $tokens = Token::select('tokens.id', 'tokens.token_id', 'tokens.name', 'tokens.description', 'image', 'thumbnail', 'attributes', 'priority', 'to', 'transaction_hash', 'collections.contract_address', 'abi', 'collections.chain_id')
            ->leftJoin('collections', 'collection_id', 'collections.id')
            ->join('token_transfers', function($join) use ($address) {
                $join->on('token_transfers.id', 'token_transfer_id');
                $join->where('to', 'LIKE', $address);
            });

        $rewardTokens = Token::select('tokens.id', 'tokens.token_id', 'tokens.name', 'tokens.description', 'image', 'thumbnail', 'attributes', 'priority', 'to', 'transaction_hash', 'collections.contract_address', 'abi', 'collections.chain_id')
            ->where('collection_id', 8)
            ->leftJoin('collections', 'collection_id', 'collections.id')
            ->join('token_transfers', function($join) use ($address) {
                $join->on('tokens.token_id', 'token_transfers.token_id');
                $join->where('token_transfers.contract_address', 'LIKE', config('ownly.contract_address_rewards'));
                $join->where('to', $address);
                $join->where('is_current', 1);
            });

        $tokens = $tokens->unionAll($rewardTokens)
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(12);

        foreach($tokens as $i => $token) {
            $token['favorite_count'] = Favorite::where('contract_address', $token['contract_address'])
                ->where('token_id', $token['token_id'])
                ->where('status', 1)
                ->count();

            $status = Favorite::where('address', $address)
                ->where('contract_address', $token['contract_address'])
                ->where('token_id', $token['token_id'])
                ->where('status', 1)
                ->first();

            $token['favorite_status'] = $status ? true : false;
        }

        return response()->json([
            'tokens' => $tokens
        ]);
    }
}
