<?php

namespace App\Http\Controllers;

use App\BadgeClaim;
use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Collection;

class BadgeController extends Controller
{
    public function index(Request $request) {
        return view('elixir.index');
    }

    public function checkTwitterAccountFollows(Request $request, $twitter_id) {
        $data = false;

        if($request->session()->has('twitter_auth')) {
            $data = $this->getTwitterFollows($request, $twitter_id, null);
        }

        if($data) {
            $badgeClaim = BadgeClaim::find($request->session()->get('twitter_auth')['id']);

            if($twitter_id == config('ownly.ownly_twitter_id')) {
                $badgeClaim->followed_ownly = 1;
            } else if($twitter_id == config('ownly.mustachioverse_twitter_id')) {
                $badgeClaim->followed_mustachioverse = 1;
            }

            $badgeClaim->update();

            session(['twitter_auth' => $badgeClaim]);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function getTwitterFollows(Request $request, $twitter_id, $pagination_token) {
        $data = false;

        $response = Http::withToken('AAAAAAAAAAAAAAAAAAAAADLEdwEAAAAAHkJO91iAyeBAf8rNi7e5C8Q7%2FOg%3D5guR9UvTPhm32R86TfuHmZwCyCnO2rZIgsP9EfagkbMBMD5XJH')
            ->get('https://api.twitter.com/2/users/' . $request->session()->get('twitter_auth')['twitter_id'] . '/following', [
                'max_results' => 1000,
                'pagination_token' => $pagination_token
            ]);

        $follows = $response['data'];

        foreach($follows as $follow) {
            if($twitter_id == $follow['id']) {
                $data = true;
                break;
            }
        }

        if(!$data && isset($response['meta']['next_token'])) {
            $data = $this->getTwitterFollows($request, $twitter_id, $response['meta']['next_token']);
        }

        return $data;
    }

    public function validateAddress(Request $request) {
        $request->validate([
            'address' => 'required',
            'signature' => 'required',
        ]);

        $data = false;

        $response = Http::post(config('ownly.nodejs_url') . '/web3/getSigningAddress', [
            'message' => config('ownly.badge_claim_message'),
            'signature' => $request->signature,
            'key' => config('ownly.api_key')
        ]);

        if(strtolower($response['signingAddress']) == strtolower($request->address)) {
            $badgeClaim = BadgeClaim::find($request->session()->get('twitter_auth')['id']);

            if(!$badgeClaim['transaction_hash']) {
                $badgeClaim->address = $request->address;
                $badgeClaim->update();

                session(['twitter_auth' => $badgeClaim]);
            }

            $data = true;
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function claimElixir(Request $request) {
        $badgeClaim = BadgeClaim::find($request->session()->get('twitter_auth')['id']);
        $collection = Collection::where('url_placeholder', 'rewards')
            ->first();

        if($badgeClaim['followed_ownly'] == 1 && $badgeClaim['followed_mustachioverse'] == 1 && $badgeClaim['address'] && !$badgeClaim['transaction_hash']) {
            $response = Http::post(config('ownly.nodejs_url') . '/web3/claimElixir', [
                'rpcUrl' => $collection->rpcUrl(),
                'contractAddress' => $collection['contract_address'],
                'abi' => $collection['abi'],
                'address' => $badgeClaim['address'],
                'key' => config('ownly.api_key')
            ]);

            if($response['transactionHash']) {
                $badgeClaim->transaction_hash = $response['transactionHash'];
                $badgeClaim->update();

                $token = Token::where('collection_id', 8)
                    ->where('token_id', 1)
                    ->first();

                $token->updateTokenTransaction();

                session(['twitter_auth' => $badgeClaim]);
            }
        }

        return response()->json([
            'data' => $collection->blockchainExplorerLink() . 'tx/' . $badgeClaim['transaction_hash']
        ]);
    }
}
