<?php

namespace App\Http\Controllers;

use App\GenesisBlockToken;
use App\MarketItemFavorite;
use App\TitansToken;
use App\TokenTransfer;
use Illuminate\Http\Request;

class GenesisBlockController extends Controller
{
    public function getGenesisBlockTokens($address, $contract_address) {
        $genesisBlockTokens = GenesisBlockToken::select('genesis_block_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->paginate(10);

        foreach($genesisBlockTokens as $genesisBlockToken) {
            $genesisBlockToken['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $genesisBlockToken['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $genesisBlockToken['id'])
                ->where('status', 1)
                ->first();

            $genesisBlockToken['favorite_status'] = $status ? true : false;
        }

        return $genesisBlockTokens;
    }

    public function getGenesisBlockToken($address, $contract_address, $id) {
        $genesisBlockToken = GenesisBlockToken::select('genesis_block_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('genesis_block_tokens.id', $id)
            ->first();

        $genesisBlockToken['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $genesisBlockToken['favorite_status'] = $status ? true : false;

        $eth_chain_ids = [1, 4];

        $genesisBlockToken['transfers'] = TokenTransfer::whereIn('chain_id', $eth_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        return $genesisBlockToken;
    }
}
