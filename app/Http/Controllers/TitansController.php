<?php

namespace App\Http\Controllers;

use App\MarketAccount;
use App\MarketItemFavorite;
use App\Offer;
use App\TitansToken;
use App\TokenTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TitansController extends Controller
{
    public function getTitans($address, $contract_address) {
        $titans = TitansToken::select('titans_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->paginate(10);

        foreach($titans as $titan) {
            $titan['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $titan['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $titan['id'])
                ->where('status', 1)
                ->first();

            $titan['favorite_status'] = $status ? true : false;
        }

        return $titans;
    }

    public function getTitan($address, $contract_address, $id) {
        $titan = TitansToken::select('titans_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('titans_tokens.id', $id)
            ->first();

        $titan['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $titan['favorite_status'] = $status ? true : false;

        $bsc_chain_ids = [56, 97];

        $titan['transfers'] = TokenTransfer::whereIn('chain_id', $bsc_chain_ids)
            ->where('contract_address', 'LIKE', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        $titan['offers'] = Offer::select('id', 'date_time_offered', 'offeror', 'amount', 'currency', 'until', 'expiration')
            ->whereIn('chain_id', $bsc_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->whereNull('invalid')
            ->orderBy('date_time_offered', 'desc')
            ->get();

        foreach($titan['offers'] as $offer) {
            $marketAccount = MarketAccount::where('address', 'LIKE', $offer['offeror'])
                ->first();

            $offer['name'] = ($marketAccount) ? $marketAccount['name'] : null;
            $offer['date_time_offered'] = Carbon::parse($offer['date_time_offered'])->format('Y-F-d<\b\r>h:i A');
        }

        return $titan;
    }
}
