<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Offer;
use App\TokenTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function makeOffer(Request $request) {
        $request->validate([
            'chain_id' => 'required',
            'contract_address' => 'required',
            'token_id' => 'required',
            'offeror' => 'required',
            'signature' => 'required',
            'currency' => 'required',
            'amount' => 'required',
            'offer_expiration' => 'required',
        ]);

        $tokenTransfer = TokenTransfer::where('chain_id', $request->chain_id)
            ->where('contract_address', 'LIKE', $request->contract_address)
            ->where('token_id', $request->token_id)
            ->where('is_current', 1)
            ->first();

        if(!$tokenTransfer) {
            abort(404);
        }

        $offer = new Offer();
        $offer->chain_id = $request->chain_id;
        $offer->contract_address = $request->contract_address;
        $offer->token_id = $request->token_id;
        $offer->owner = $tokenTransfer['to'];
        $offer->offeror = $request->offeror;
        $offer->signature = $request->signature;
        $offer->currency = $request->currency;
        $offer->amount = $request->amount;
        $offer->until = Carbon::now()->addDays($request->offer_expiration);
        $offer->date_time_offered = Carbon::now();
        $offer->save();

        return $offer;
    }
}
