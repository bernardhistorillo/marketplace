<?php

namespace App\Http\Controllers;

use App\GenesisBlockToken;
use App\MarketItemFavorite;
use App\SagesRantCollectible;
use App\TitansToken;
use App\TokenTransfer;
use Illuminate\Http\Request;

class SagesRantCollectibleController extends Controller
{
    public function getSagesRantCollectibles($address, $contract_address) {
        $sagesRantCollectibles = SagesRantCollectible::select('sages_rant_collectibles.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->paginate(12);

        foreach($sagesRantCollectibles as $sagesRantCollectible) {
            $sagesRantCollectible['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $sagesRantCollectible['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $sagesRantCollectible['id'])
                ->where('status', 1)
                ->first();

            $sagesRantCollectible['favorite_status'] = $status ? true : false;
        }

        return $sagesRantCollectibles;
    }

    public function getSagesRantCollectible($address, $contract_address, $id) {
        $sagesRantCollectible = SagesRantCollectible::select('sages_rant_collectibles.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('sages_rant_collectibles.id', $id)
            ->first();

        $sagesRantCollectible['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $sagesRantCollectible['favorite_status'] = $status ? true : false;

        $eth_chain_ids = [1, 4];

        $sagesRantCollectible['transfers'] = TokenTransfer::whereIn('chain_id', $eth_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        return $sagesRantCollectible;
    }
}
