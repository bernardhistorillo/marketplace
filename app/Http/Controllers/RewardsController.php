<?php

namespace App\Http\Controllers;

use App\MarketItemFavorite;
use App\RewardsToken;
use App\TokenTransfer;

class RewardsController extends Controller
{
    public function getRewards($address, $contract_address) {
        $rewards = RewardsToken::select('id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'supply')
            ->paginate(12);

        foreach($rewards as $reward) {
            $reward['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $reward['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $reward['id'])
                ->where('status', 1)
                ->first();

            $reward['favorite_status'] = $status ? true : false;
        }

        return $rewards;
    }

    public function getReward($address, $contract_address, $id) {
        $rewards_token = RewardsToken::select('rewards_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('rewards_tokens.id', $id)
            ->first();

        $rewards_token['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $rewards_token['favorite_status'] = $status ? true : false;

        $matic_chain_ids = [137, 80001];

        $rewards_token['transfers'] = TokenTransfer::whereIn('chain_id', $matic_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        return $rewards_token;
    }
}
