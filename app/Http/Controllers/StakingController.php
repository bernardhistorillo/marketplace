<?php

namespace App\Http\Controllers;

use App\StakingEarner;
use App\StakingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StakingController extends Controller
{
    public function addStakingTransactions(Request $request) {
        $OWN_ADDRESS = "0x7665cb7b0d01df1c9f9b9cc66019f00abd6959ba";
        $SFUEL_ADDRESS = "0x37ac4d6140e54304d77437a5c11924f61a2d976f";

        $liquidity_stakings = [
            '0xda687D1d31392B957166f6C16E508b484f3A70cb'
        ];

        $pool_based_stakings = [
            '0x5950060609b2037330c16491aa9f2cd3ed6db154'
        ];

        if(!is_array($request->transactions)) {
            $transactions = json_decode($request->transactions, true);

            foreach($transactions as $transaction) {
                $staking_transaction = StakingTransaction::where('transaction', $transaction['tx_hash'])
                    ->first();

                if(!$staking_transaction) {
                    $staking_transaction = new StakingTransaction();
                    $staking_transaction->staking = $request->staking;
                    $staking_transaction->transaction = $transaction['tx_hash'];

                    if(in_array($request->staking, $liquidity_stakings)) {
                        $staking_transaction->address = $transaction['decoded']['params'][0]['value'];

                        if($transaction['decoded']['name'] == 'Staked') {
                            $staking_transaction->staked = bcdiv($transaction['decoded']['params'][1]['value'],'1000000000000000000',18);
                        }

                        if($transaction['decoded']['name'] == 'RewardPaid') {
                            $staking_transaction->claimed = bcdiv($transaction['decoded']['params'][1]['value'],'1000000000000000000',18);
                        }
                    } else if(in_array($request->staking, $pool_based_stakings)) {
                        $staking_transaction->address = $transaction['from_address'];

                        foreach($transaction['log_events'] as $log_event) {
                            if($log_event['decoded'] && $log_event['decoded']['name'] === "Transfer") {
                                if($log_event['sender_address'] == $OWN_ADDRESS) {
                                    if(in_array($log_event['decoded']['params'][1]['value'], $pool_based_stakings)) {
                                        $staking_transaction->staked = bcdiv($log_event['decoded']['params'][2]['value'],'1000000000000000000',18);
                                    }
                                } else if($log_event['sender_address'] == $SFUEL_ADDRESS) {
                                    if(in_array($log_event['decoded']['params'][0]['value'], $pool_based_stakings)) {
                                        $staking_transaction->claimed = bcdiv($log_event['decoded']['params'][2]['value'],'1000000000000000000',18);
                                    }
                                }
                            }
                        }
                    }

                    $staking_transaction->save();
                }
            }

            $earners = StakingTransaction::select('address')
                ->where('staking', $request->staking)
                ->groupBy('address')
                ->get()
                ->pluck('address');

            return response()->json([
                'earners' => $earners
            ]);
        }
    }

    public function updateStakingEarnings(Request $request) {
        $claimed = StakingTransaction::where('staking', $request->staking)
            ->where('address', $request->address)
            ->sum('claimed');

        $total = $claimed + bcdiv($request->earned,'1000000000000000000',18);

        $staking_earner = StakingEarner::where('staking', $request->staking)
            ->where('address', $request->address)
            ->first();

        $staked = bcdiv($request->staked,'1000000000000000000',18);

        if($staking_earner) {
            $staking_earner->staked = $staked;
            $staking_earner->amount = $total;
            $staking_earner->update();
        } else {
            $staking_earner = new StakingEarner();
            $staking_earner->staking = $request->staking;
            $staking_earner->address = $request->address;
            $staking_earner->staked = $staked;
            $staking_earner->amount = $total;
            $staking_earner->save();
        }
    }

    public function getStakingTopEarners(Request $request) {
        $excluded_addresses = [
            '0xb1d9578cfd5211a795926e795530cc3c0517cc7f',
            '0x7ef49272bb9edbf9350b2d884c4ac0af34d9826f',
        ];

        return StakingEarner::select('address', 'staked', 'amount')
            ->where('staking', $request->staking)
            ->whereNotIn('address', $excluded_addresses)
            ->orderBy('amount', 'desc')
            ->get();
    }
}
