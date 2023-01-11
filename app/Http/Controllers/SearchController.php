<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\Collection;
use App\GenesisBlockToken;
use App\Jobs\FetchTokenData;
use App\Mustachio;
use App\MustachioverseAsset;
use App\OhaToken;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use App\Token;
use App\TokenTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request) {
        $request->validate([
            'value' => 'required|string'
        ]);

        $nodeServer = (config('app.env') == 'local') ? 'localhost' : 'http://ownly.market';

        $response = Http::get($nodeServer . ':8080/web3/isAddress/' . $request->value);

        if(isset($response['isAddress']) && $response['isAddress']) {
            $contractAddress = $request->value;

            $this->fetchTokenData($contractAddress, 0);

            $result = Collection::addSelect('id')
                ->addSelect('name')
                ->addSelect('contract_address')
                ->addSelect('chain_id')
                ->addSelect('url')
                ->addSelect(DB::raw('logo as thumbnail'))
                ->addSelect(DB::raw('null as collection'))
                ->addSelect(DB::raw('"collection" as type'))
                ->where('contract_address', 'LIKE', $contractAddress)
                ->limit(20)
                ->orderBy('type', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $search = '%' . $request->value . '%';

            $collections = Collection::addSelect('id')
                ->addSelect('name')
                ->addSelect('contract_address')
                ->addSelect('chain_id')
                ->addSelect('url')
                ->addSelect(DB::raw('logo as thumbnail'))
                ->addSelect(DB::raw('null as collection'))
                ->addSelect(DB::raw('"collection" as type'))
                ->where('name', 'LIKE', $search);

            $tokens = Token::addSelect(DB::raw('token_id as id'))
                ->addSelect('tokens.name')
                ->addSelect('contract_address')
                ->addSelect('chain_id')
                ->addSelect(DB::raw('null as url'))
                ->addSelect('thumbnail')
                ->addSelect(DB::raw('collections.name as collection'))
                ->addSelect(DB::raw('"token" as type'))
                ->leftJoin('collections', 'collection_id', 'collections.id')
                ->where('tokens.name', 'LIKE', $search);

            $result = $collections->unionAll($tokens)
                ->limit(20)
                ->orderBy('type', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        }

        foreach($result as $item) {
            $network = '';
            if($item['chain_id'] == config('ownly.chain_id_bsc') || $item['chain_id'] == 56) {
                $network = 'bsc';
            } else if($item['chain_id'] == config('ownly.chain_id_eth') || $item['chain_id'] == 1) {
                $network = 'eth';
            } else if($item['chain_id'] == config('ownly.chain_id_matic') || $item['chain_id'] == 137) {
                $network = 'matic';
            }

            if($item['type'] == 'token') {
                $item['url'] = config('ownly.marketplace_url') . '?network=' . $network . '&contract=' . $item['contract_address'] . '&token=' . $item['id'];
            } else {
                if($item['url']) {
                    $item['url'] = config('ownly.marketplace_url') . '?collection=' . $item['url'];
                } else {
                    $item['url'] = config('ownly.marketplace_url') . '?collection=' . $network . ':' . $item['contract_address'];
                }
            }

            unset($item['contract_address']);
            unset($item['chain_id']);
        }

        return response()->json([
            'data' => $result
        ]);
    }

    protected function fetchTokenData($contractAddress, $pageNumber) {
        $chainIds = [1, 56, 137];

        foreach($chainIds as $chainId) {
            $response = Http::get('https://api.covalenthq.com/v1/' . $chainId . '/tokens/' . $contractAddress . '/nft_token_ids/?format=JSON&page-size=1000&page-number=' . $pageNumber . '&key=ckey_994c8fdd549f44fa9b2b27f59a0');

            if($response && isset($response['data']) && isset($response['data']['items']) && count($response['data']['items']) > 0) {
                FetchTokenData::dispatch($chainId, $response['data']['items']);

                if($response['data']['pagination']['has_more']) {
                    $this->fetchTokenData($contractAddress, ++$pageNumber);
                }
            }
        }
    }
}
