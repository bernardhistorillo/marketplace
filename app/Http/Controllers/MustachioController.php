<?php

namespace App\Http\Controllers;

use App\MarketItemFavorite;
use App\Mustachio;
use App\MustachioPathfinderMarauder;
use App\Notifications\MintedMustachio;
use App\Token;
use App\TokenTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

//
class MustachioController extends Controller
{

    public function getMustachios($address, $contract_address, $total_supply) {
        $mustachio_count = Mustachio::where('exists', 1)
            ->count();

        if($total_supply > $mustachio_count) {
            $mustachio = Mustachio::find($mustachio_count);

            if(!$mustachio['exists']) {
                $this->check_if_minted($mustachio, '1', '0x9e7a3A2e0c60c70eFc115BF03e6c544Ef07620E5');
            }
        }

        $mustachios = Mustachio::where('exists', 1)
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->select('mustachios.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->paginate(12);

        foreach($mustachios as $mustachio) {
            $mustachio['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
                ->where('token_id', $mustachio['id'])
                ->where('status', 1)
                ->count();

            $status = MarketItemFavorite::where('address', $address)
                ->where('contract_address', $contract_address)
                ->where('token_id', $mustachio['id'])
                ->where('status', 1)
                ->first();

            $mustachio['favorite_status'] = $status ? true : false;
        }

        return $mustachios;
    }

    public function getMustachio($id) {
        $mustachio = Mustachio::select('id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'trans_bg', 'exists')
            ->where('id', $id)
            ->first();

        if(!$mustachio['exists']) {
            $mustachio = $this->check_if_minted($mustachio, '1', '0x9e7a3A2e0c60c70eFc115BF03e6c544Ef07620E5');

            if(!$mustachio) {
                abort(404);
            }
        }

        $mustachio->attributes = json_decode($mustachio->attributes, true);

        return $mustachio;
    }

    public function getMustachioToMarketplace($address, $contract_address, $id) {
        $mustachio = Mustachio::select('mustachios.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'trans_bg', 'to', 'transaction_hash', 'exists')
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('mustachios.id', $id)
            ->first();

        if(!$mustachio['exists']) {
            $mustachio = $this->check_if_minted($mustachio, '1', '0x9e7a3A2e0c60c70eFc115BF03e6c544Ef07620E5');

            if(!$mustachio) {
                abort(404);
            }
        }

        $mustachio['favorite_count'] = MarketItemFavorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = MarketItemFavorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $mustachio['favorite_status'] = $status ? true : false;

        $eth_chain_ids = [1, 4];

        $mustachio['transfers'] = TokenTransfer::whereIn('chain_id', $eth_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        return $mustachio;
    }

    public function getMustachioPathfinderMarauder($id) {
        $mustachioPathfinderMarauder = MustachioPathfinderMarauder::select('id', 'name', 'description', 'image', 'attributes', 'exists')
            ->where('id', $id)
            ->first();

        if(!$mustachioPathfinderMarauder['exists']) {
            $mustachioPathfinderMarauder = $this->check_if_minted($mustachioPathfinderMarauder, config('ownly.chain_id_bsc'), config('ownly.contract_address_3dmustachios'));

            if(!$mustachioPathfinderMarauder) {
                abort(404);
            } else {
                $collectionId = 9;
                $token = Token::where('collection_id', $collectionId)
                    ->where('token_id', $mustachioPathfinderMarauder['id'])
                    ->first();

                if(!$token) {
                    $token = new Token();
                }

                $token->collection_id = $collectionId;
                $token->token_id = $mustachioPathfinderMarauder['id'];
                $token->name = $mustachioPathfinderMarauder['name'];
                $token->description = $mustachioPathfinderMarauder['description'];
                $token->image = $mustachioPathfinderMarauder['image'];
                $token->thumbnail = $mustachioPathfinderMarauder['image'];
                $token->attributes = $mustachioPathfinderMarauder['attributes'];
                $token->save();
            }
        }

//        $mustachioPathfinderMarauder->attributes = json_decode($mustachioPathfinderMarauder->attributes, true);

        return $mustachioPathfinderMarauder;
    }

    public static function check_if_minted($mustachio, $chain_id, $contract_address) {
        $response = Http::get('https://api.covalenthq.com/v1/' . $chain_id . '/tokens/' . $contract_address . '/nft_transactions/' . $mustachio['id'] . '/?&key=ckey_994c8fdd549f44fa9b2b27f59a0');

        if(count($response['data']['items'][0]['nft_transactions']) > 0) {
            $mustachio->update([
                'exists' => 1
            ]);

            // notify slack
//            $mustachio->notify(new MintedMustachio($mustachio));
        } else {
            return false;
        }

        return $mustachio;
    }
}
