<?php

namespace App\Jobs;

use App\Collection;
use App\Token;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchTokenData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chainId;
    protected $tokens;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($chainId, $tokens)
    {
        $this->chainId = $chainId;
        $this->tokens = $tokens;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $chainId = $this->chainId;
        $tokens = $this->tokens;

        $collection = Collection::where('contract_address', 'LIKE', $tokens[0]['contract_address'])
            ->where('chain_id', $chainId)
            ->first();

        if(!$collection) {
            $collection = new Collection();
            $collection->contract_address = $tokens[0]['contract_address'];
            $collection->chain_id = $chainId;
            $collection->name = $tokens[0]['contract_name'];
            $collection->save();

            $explorers = [
                '1' => [
                    'endpoint' => 'https://api.etherscan.io',
                    'key' => config('ownly.blockchain_explorer_api_key_eth')
                ],
                '56' => [
                    'endpoint' => 'https://api.bscscan.com',
                    'key' => config('ownly.blockchain_explorer_api_key_bsc')
                ],
                '136' => [
                    'endpoint' => 'https://api.polygonscan.com',
                    'key' => config('ownly.blockchain_explorer_api_key_matic')
                ]
            ];

            $response = Http::get($explorers[$chainId]['endpoint'] . '/api?module=contract&action=getabi&address=' . $tokens[0]['contract_address'] . '&apikey=' . $explorers[$chainId]['key']);

            if($response && $response['result']) {
                $collection->abi = $response['result'];
            }

            $collection->update();
        }

        $nodeServer = (config('app.env') == 'local') ? 'localhost' : 'http://ownly.market';

        foreach($tokens as $token) {
            $existingToken = Token::where('token_id', $token['token_id'])
                ->join('collections', function($join) use ($token, $chainId) {
                    $join->on('collections.id', 'tokens.collection_id');
                    $join->where('contract_address', 'LIKE', $token['contract_address']);
                    $join->where('chain_id', $chainId);
                })
                ->first();

            if(!$existingToken) {
                Http::get($nodeServer . ':8080/web3/getTokenURI/' . $chainId . '/' . $token['contract_address'] . '/' . $token['token_id']);
            }
        }
    }
}
