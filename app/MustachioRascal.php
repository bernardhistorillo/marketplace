<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MustachioRascal extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'attributes',
        'exists',
    ];

    public function checkIfMinted() {
        $response = Http::get('https://api.covalenthq.com/v1/1/tokens/0x3f5c11fF5C004313A5D1Bb0b5160551E05988569/nft_transactions/' . ($this->id - 1) . '/?&key=ckey_994c8fdd549f44fa9b2b27f59a0');

        if(count($response['data']['items'][0]['nft_transactions']) > 0) {
            return $response['data']['items'][0]['nft_transactions'][0]['log_events'][0]['decoded']['params'][1]['value'];
        }

        return null;
    }
}
