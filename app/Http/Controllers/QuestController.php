<?php

namespace App\Http\Controllers;

use App\QuestOneReward;
use App\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuestController extends Controller
{
    public function getQuestOneRewardTest(Request $request, $holder, $tokenId, $signature) {
//        $message = 'Thank you for participating in the closed beta testing. As one of the first to finish the quest, you will receive a Private Key of an address with 500,000 OWN tokens.';
//
//        $response = Http::get('http://ownly-api.test:8080/web3/getSigningAddress/' . $signature . '/' . $message);
//
//        if(strtolower($response) === strtolower($holder)) {
            $mustachio = Token::select('name', 'description', 'image', 'thumbnail')
                ->where('collection_id', 4)
                ->where('tokens.token_id', $tokenId)
                ->join('token_transfers', function($join) use ($holder) {
                    $join->on('token_transfers.id', 'token_transfer_id');
                    $join->where('to', $holder);
                })
                ->first();

            if($mustachio) {
                $questOneReward = QuestOneReward::where('holder', $holder)
                    ->where('token_id', $tokenId)
                    ->whereNotNull('date_accessed')
                    ->first();

                if(!$questOneReward) {
                    $questOneReward = QuestOneReward::whereNull('holder')
                        ->whereNull('token_id')
                        ->first();

                    if($questOneReward) {
                        $questOneReward->holder = $holder;
                        $questOneReward->token_id = $tokenId;
                        $questOneReward->date_accessed = Carbon::now();
                        $questOneReward->save();

                        $reward = base64_encode($questOneReward['private_key']);
                    } else {
                        $reward = 'false';
                    }
                } else {
                    $reward = base64_encode($questOneReward['private_key']);
                }
            } else {
                $reward = 'false';
            }
//        } else {
//            $reward = 'false';
//        }

        return response()->json([
            'reward' => $reward
        ]);
    }

    public function getQuestOneReward(Request $request, $holder, $tokenId, $signature) {
        // http://ownly-api.test/api/quest/getQuestOneReward/0x7ef49272bb9EDBF9350B2D884C4Ac0aF34D9826F/2/0x0929a842b0f6f80b5c1054dd6edd5e9924a377e511adb2b30fb1cc570c66c68731ed033ae3ea7393eed0f2dfe20d0b04e0c4e1e0b9b6effb49711e05e9688f7c1c

        $message = 'Thank you for participating in the closed beta testing. As one of the first to finish the quest, you will receive a Private Key of an address with 500,000 OWN tokens.';

        $response = Http::get('http://ownly.market:8080/web3/getSigningAddress/' . $signature . '/' . $message);

        if(strtolower($response) === strtolower($holder)) {
            $mustachio = Token::select('name', 'description', 'image', 'thumbnail')
                ->where('collection_id', 4)
                ->where('tokens.token_id', $tokenId)
                ->join('token_transfers', function($join) use ($holder) {
                    $join->on('token_transfers.id', 'token_transfer_id');
                    $join->where('to', $holder);
                })
                ->first();

            if($mustachio) {
                $questOneReward = QuestOneReward::where('holder', $holder)
                    ->where('token_id', $tokenId)
                    ->whereNotNull('date_accessed')
                    ->first();

                if(!$questOneReward) {
                    $questOneReward = QuestOneReward::whereNull('holder')
                        ->whereNull('token_id')
                        ->first();

                    if($questOneReward) {
                        $questOneReward->holder = $holder;
                        $questOneReward->token_id = $tokenId;
                        $questOneReward->date_accessed = Carbon::now();
                        $questOneReward->save();

                        $reward = base64_encode($questOneReward['private_key']);
                    } else {
                        $reward = 'false';
                    }
                } else {
                    $reward = base64_encode($questOneReward['private_key']);
                }
            } else {
                $reward = 'false';
            }
        } else {
            $reward = 'false';
        }

        return response()->json([
            'reward' => $reward
        ]);
    }
}
