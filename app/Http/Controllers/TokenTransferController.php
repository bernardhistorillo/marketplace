<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\Collection;
use App\GenesisBlockToken;
use App\Favorite;
use App\Mustachio;
use App\OhaToken;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use App\Token;
use App\TokenTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TokenTransferController extends Controller
{
    public function getSales(Request $request) {
        $curated = Collection::select('contract_address')
            ->where('is_curated', 1)
            ->pluck('contract_address');

        if($request->periodical == "Annual") {
            $date = Carbon::parse($request->year . '-01-01');

            $sales_per_token['own'] = TokenTransfer::where('currency', 'OWN')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-01-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-12-31 23:59:59'))
                ->sum('value');

            $sales_per_token['bnb'] = TokenTransfer::where('currency', 'BNB')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-01-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-12-31 23:59:59'))
                ->sum('value');

            $sales_per_token['eth'] = TokenTransfer::where('currency', 'ETH')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-01-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-12-31 23:59:59'))
                ->sum('value');

            $sales = TokenTransfer::where('value', '>', 0)
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-01-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-12-31 23:59:59'))
                ->orderBy('signed_at', 'desc')
                ->paginate(20);
        } else if($request->periodical == "Quarterly") {
            $date = Carbon::parse($request->year . '-' . $request->quarter . '-01');
            $end_of_date = Carbon::parse($request->year . '-' . $request->quarter . '-01')->addMonths(2)->format('Y-m-t 23:59:59');

            $sales_per_token['own'] = TokenTransfer::where('currency', 'OWN')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $end_of_date)
                ->sum('value');

            $sales_per_token['bnb'] = TokenTransfer::where('currency', 'BNB')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $end_of_date)
                ->sum('value');

            $sales_per_token['eth'] = TokenTransfer::where('currency', 'ETH')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $end_of_date)
                ->sum('value');

            $sales = TokenTransfer::where('value', '>', 0)
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $end_of_date)
                ->orderBy('signed_at', 'desc')
                ->paginate(20);
        } else if($request->periodical == "Monthly") {
            $date = Carbon::parse($request->year . '-' . $request->month . '-01');

            $sales_per_token['own'] = TokenTransfer::where('currency', 'OWN')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-m-t 23:59:59'))
                ->sum('value');

            $sales_per_token['bnb'] = TokenTransfer::where('currency', 'BNB')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-m-t 23:59:59'))
                ->sum('value');

            $sales_per_token['eth'] = TokenTransfer::where('currency', 'ETH')
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-m-t 23:59:59'))
                ->sum('value');

            $sales = TokenTransfer::where('value', '>', 0)
                ->whereIn('contract_address', $curated)
                ->where('signed_at', '>=', $date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $date->format('Y-m-t 23:59:59'))
                ->orderBy('signed_at', 'desc')
                ->paginate(20);
        }

        $graph_date = Carbon::now()->subMonths(11);
        $graph['eth'] = [];
        $graph['own'] = [];
        $graph['bnb'] = [];
        $graph['labels'] = [];

        for($i = 0; $i < 12; $i++) {
            array_push($graph['eth'], floatval(TokenTransfer::where('currency', 'ETH')
                ->where('signed_at', '>=', $graph_date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $graph_date->format('Y-m-t 23:59:59'))
                ->sum('value')));

            array_push($graph['bnb'], floatval(TokenTransfer::where('currency', 'BNB')
                ->where('signed_at', '>=', $graph_date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $graph_date->format('Y-m-t 23:59:59'))
                ->sum('value')));

            array_push($graph['own'], floatval(TokenTransfer::where('currency', 'OWN')
                ->where('signed_at', '>=', $graph_date->format('Y-m-01 00:00:00'))
                ->where('signed_at', '<=', $graph_date->format('Y-m-t 23:59:59'))
                ->sum('value')) / 1000000);

            array_push($graph['labels'], $graph_date->format('F'));

            $graph_date->addMonth();
        }

        foreach($sales as $i => $sale) {
            $sale['formatted_date'] = Carbon::parse($sale['signed_at'])->isoFormat('llll');

            if($sale['chain_id'] == config('ownly.chain_id_bsc')) {
                if(strtolower($sale['contract_address']) == config('ownly.contract_address_titans')) {
                    $sale['collection'] = "Titans of Industry";
                    $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=titans-of-industry';
                    $sale['token_url'] = config('ownly.marketplace_url') . '?network=bsc&contract=' . config('ownly.contract_address_titans') . '&token=' . $sale['token_id'];
                    $sale['name'] = TitansToken::find($sale['token_id'])['name'];
                }

                $sale['transaction_link'] = config('ownly.blockchain_explorer_bsc') . 'tx/' . $sale['transaction_hash'];
            } else if($sale['chain_id'] == config('ownly.chain_id_eth')) {
                if(strtolower($sale['contract_address']) == config('ownly.contract_address_chenink')) {
                    if($sale['token_id'] >= 1 && $sale['token_id'] <= 53) {
                        $sale['collection'] = "CryptoSolitaire";
                        $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=cryptosolitaire';
                        $sale['token_url'] = config('ownly.marketplace_url') . '?network=eth&contract=' . config('ownly.contract_address_chenink') . '&token=' . $sale['token_id'];
                        $sale['name'] = ChenInkToken::find($sale['token_id'])['name'];
                    } else if($sale['token_id'] >= 54 && $sale['token_id'] <= 74) {
                        $sale['collection'] = "Inkvadyrz";
                        $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=inkvadyrz';
                        $sale['token_url'] = config('ownly.marketplace_url') . '?network=eth&contract=' . config('ownly.contract_address_chenink') . '&token=' . $sale['token_id'];
                        $sale['name'] = ChenInkToken::find($sale['token_id'])['name'];
                    }
                } else if(strtolower($sale['contract_address']) == config('ownly.contract_address_mustachios')) {
                    $sale['collection'] = "The Mustachios";
                    $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=the-mustachios';
                    $sale['token_url'] = config('ownly.marketplace_url') . '?network=eth&contract=' . config('ownly.contract_address_mustachios') . '&token=' . $sale['token_id'];
                    $sale['name'] = Mustachio::find($sale['token_id'])['name'];
                } else if(strtolower($sale['contract_address']) == config('ownly.contract_address_genesis_block')) {
                    $sale['collection'] = "Genesis Block";
                    $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=genesis-block';
                    $sale['token_url'] = config('ownly.marketplace_url') . '?network=eth&contract=' . config('ownly.contract_address_genesis_block') . '&token=' . $sale['token_id'];
                    $sale['name'] = GenesisBlockToken::find($sale['token_id'])['name'];
                } else if(strtolower($sale['contract_address']) == config('ownly.contract_address_the_sages_rant_collectibles')) {
                    $sale['collection'] = "The Sages Rant Collectibles";
                    $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=the-sages-rant-collectibles';
                    $sale['token_url'] = config('ownly.marketplace_url') . '?network=eth&contract=' . config('ownly.contract_address_the_sages_rant_collectibles') . '&token=' . $sale['token_id'];
                    $sale['name'] = SagesRantCollectible::find($sale['token_id'])['name'];
                } else if(strtolower($sale['contract_address']) == config('ownly.contract_address_oha')) {
                    $sale['collection'] = "Owny House Of Art";
                    $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=oha';
                    $sale['token_url'] = config('ownly.marketplace_url') . '?network=eth&contract=' . config('ownly.contract_address_oha') . '&token=' . $sale['token_id'];
                    $sale['name'] = OhaToken::find($sale['token_id'])['name'];
                }

                $sale['transaction_link'] = config('ownly.blockchain_explorer_eth') . 'tx/' . $sale['transaction_hash'];
            } else if($sale['chain_id'] == config('ownly.chain_id_matic')) {
                if(strtolower($sale['contract_address']) == config('ownly.contract_address_rewards')) {
                    $sale['collection'] = "Ownly Rewards";
                    $sale['collection_url'] = config('ownly.marketplace_url') . '?collection=rewards';
                    $sale['token_url'] = config('ownly.marketplace_url') . '?network=matic&contract=' . config('ownly.contract_address_rewards') . '&token=' . $sale['token_id'];
                    $sale['name'] = RewardsToken::find($sale['token_id'])['name'];
                }

                $sale['transaction_link'] = config('ownly.blockchain_explorer_matic') . 'tx/' . $sale['transaction_hash'];
            }
        }

        return response()->json([
            'sales_per_token' => $sales_per_token,
            'date' => [
                'year' => $date->format('Y'),
                'month' => $date->format('m'),
            ],
            'graph' => $graph,
            'pagination' => $sales,
        ]);
    }
}
