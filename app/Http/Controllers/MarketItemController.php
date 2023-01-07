<?php

namespace App\Http\Controllers;

use App\MarketItem;
use Illuminate\Http\Request;

class MarketItemController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'item_id' => 'required',
            'message_hash' => 'required',
            'signature' => 'required',
            'event' => 'required',
            'apiKey' => 'required',
        ]);

        if($request->apiKey != config('ownly.api_key')) {
            abort(404);
        }

        $market_item = MarketItem::where('item_id', $request->item_id)
            ->where('message_hash', $request->message_hash)
            ->where('signature', $request->signature)
            ->first();

        if(!$market_item) {
            $market_item = new MarketItem;
            $market_item->chain_id = $request->chain_id;
            $market_item->item_id = $request->item_id;
            $market_item->message_hash = $request->message_hash;
            $market_item->signature = $request->signature;
            $market_item->event = $request->event;
            $market_item->save();
        }

        return response()->json([
            'market_item' => $market_item
        ]);
    }

    public function getMarketItems(Request $request) {
        $marketItems = MarketItem::where('chain_id', $request->chainId)
            ->get();

        $marketItemsTemp = [];

        foreach($marketItems as $marketItem) {
            $marketItemsTemp[$marketItem['item_id']] = $marketItem;
        }

        return response()->json([
            'market_items' => $marketItemsTemp
        ]);
    }
}
