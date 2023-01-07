<?php

namespace App\Http\Controllers;

use App\MarketItemFavorite;
use App\OhaToken;
use App\SagesRantCollectible;
use App\TokenTransfer;
use Illuminate\Http\Request;

class OhaController extends Controller
{
    public function getOhaTokens($address, $contract_address) {
        $ohaTokens = OhaToken::select('oha_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->paginate(12);

        foreach($ohaTokens as $ohaToken) {
            $ohaToken['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $ohaToken['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $ohaToken['id'])
                ->where('status', 1)
                ->first();

            $ohaToken['favorite_status'] = $status ? true : false;
        }

        return $ohaTokens;
    }

    public function getOhaToken($address, $contract_address, $id) {
        $ohaToken = OhaToken::select('oha_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('oha_tokens.id', $id)
            ->first();

        $ohaToken['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $ohaToken['favorite_status'] = $status ? true : false;

        $eth_chain_ids = [1, 4];

        $ohaToken['transfers'] = TokenTransfer::whereIn('chain_id', $eth_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        return $ohaToken;
    }
}
