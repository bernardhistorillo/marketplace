<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\MarketItemFavorite;
use App\TokenTransfer;

class ChenInkController extends Controller
{
    public function getCryptosolitaires($address, $contract_address) {
        $cryptosolitaires = ChenInkToken::select('chen_ink_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('chen_ink_tokens.id', '>=', 1)
            ->where('chen_ink_tokens.id', '<=', 53)
            ->orderBy('priority', 'desc')
            ->paginate(12);

        foreach($cryptosolitaires as $cryptosolitaire) {
            $cryptosolitaire['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $cryptosolitaire['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $cryptosolitaire['id'])
                ->where('status', 1)
                ->first();

            $cryptosolitaire['favorite_status'] = $status ? true : false;
        }

        return $cryptosolitaires;
    }

    public function getCryptosolitaire($address, $contract_address, $id) {
        $chen_ink_token = ChenInkToken::select('chen_ink_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('chen_ink_tokens.id', $id)
            ->first();

        $chen_ink_token['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $chen_ink_token['favorite_status'] = $status ? true : false;

        $eth_chain_ids = [1, 4];

        $chen_ink_token['transfers'] = TokenTransfer::whereIn('chain_id', $eth_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        return $chen_ink_token;
    }

    public function getInkvadyrz($address, $contract_address) {
        $inkvadyrz = ChenInkToken::select('chen_ink_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('chen_ink_tokens.id', '>=', 54)
            ->where('chen_ink_tokens.id', '<=', 73)
            ->paginate(12);

        foreach($inkvadyrz as $inkvadyr) {
            $inkvadyr['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $inkvadyr['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $inkvadyr['id'])
                ->where('status', 1)
                ->first();

            $inkvadyr['favorite_status'] = $status ? true : false;
        }

        return $inkvadyrz;
    }

    public function getInkvadyr($address, $contract_address, $id) {
        $chen_ink_token = ChenInkToken::select('chen_ink_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('chen_ink_tokens.id', $id)
            ->first();

        $chen_ink_token['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $chen_ink_token['favorite_status'] = $status ? true : false;

        $eth_chain_ids = [1, 4];

        $chen_ink_token['transfers'] = TokenTransfer::whereIn('chain_id', $eth_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        return $chen_ink_token;
    }
}
