<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\Collection;
use App\GenesisBlockToken;
use App\Mustachio;
use App\OhaToken;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use App\TokenTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request) {
        $sales = $this->getSales($request);

        return view('sales.index', compact('sales'));
    }

    public function getSales($request) {
        $curated = Collection::select('contract_address')
            ->where('is_curated', 1)
            ->pluck('contract_address');

        if(!$request->month && !$request->quarter) {
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
        } else if($request->quarter) {
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
        } else if($request->month) {
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
            $sale['collection'] = $sale->collection();
            $sale['token'] = $sale->token();
        }

        return [
            'sales_per_token' => $sales_per_token,
            'date' => [
                'year' => $date->format('Y'),
                'month' => $date->format('m'),
            ],
            'graph' => $graph,
            'pagination' => $sales,
        ];
    }
}
