<?php

namespace App\Http\Controllers;

use Brick\Math\BigInteger;
use Cassandra\Bigint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OwnTokenController extends Controller
{
    public function getCirculatingSupply() {
//        $total_balance = 0;
//        $burned = 0;
//        foreach($wallets as $i => $wallet) {
//            $response = Http::get('https://api.covalenthq.com/v1/56/address/' . $wallet . '/balances_v2/?&key=ckey_994c8fdd549f44fa9b2b27f59a0');
//
//            foreach($response['data']['items'] as $token) {
//                if(strtolower($token['contract_address']) == '0x7665cb7b0d01df1c9f9b9cc66019f00abd6959ba') {
//                    $total_balance += $token['balance'] / (pow(10, 18));
//                }
//            }
//        }

//        $circulating_supply = 10000000000 - ($total_balance + $burned);

        $wallets = [
            '0x672b733c5350034ccbd265aa7636c3ebdda2223b',
            '0x175df4d77E8B16F8Cb8598a90d53C72B444D9682',
            '0xbB62583889a2409e34AF9df71585D3EFb26c9553',
            '0x337320c94210b433767b3cD8Bb9b63c107b1c269',
            '0x1d08c0a9Cd4f98d978D273b9fdad64086d2129A3'
        ];

        $balances = [
            BigInteger::of("62697126165780503120926695"),
            BigInteger::of("2000000000000000000000000000"),
            BigInteger::of("0"),
            BigInteger::of("500000000000000000000000000"),
            BigInteger::of("14329309151759169786304665"),
        ];

        $bought_back = BigInteger::of("0");
        $burned = BigInteger::of("750000000000000000000000000");

        $total_balance = BigInteger::of("0");
        foreach($balances as $balance) {
            $total_balance = $total_balance->plus($balance);
        }

        return BigInteger::of("10000000000000000000000000000")->minus($total_balance->plus($burned)->plus($bought_back));
//        return response()->json(5531498971.424963622981509103);
    }
}
