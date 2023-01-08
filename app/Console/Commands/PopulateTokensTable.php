<?php

namespace App\Console\Commands;

use App\Collection;
use App\Http\Controllers\HelperController;
use App\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class PopulateTokensTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marketplace:populate_tokens_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $out = new ConsoleOutput();

        $collectionInputs = [
            [
                'name' => 'Titans of Industry',
                'chain_id' => 56,
                'contract_address' => '0x804efc52BFa9B85A86219c191d51147566f3B327',
    //                'contract_address_testnet' => '0xB9f74a918d3bF21be452444e65039e6365DF9B98',
                'description' => 'Created by multimedia artist Eugene Oligo, our collaboration entitled Titans of Industry features the pioneers, entrepreneurs, and titans of the crypto space. This collection will surely help you recognize the big ones, their feats, and their impact on the blockchain world.',
                'token_uri' => 'https://ownly.io/nft/titans-of-industry/api/',
                'url_placeholder' => 'titans-of-industry'
            ], [
                'name' => 'Mustachios Rascals',
                'chain_id' => 1,
                'contract_address' => '0x3f5c11fF5C004313A5D1Bb0b5160551E05988569',
//                'contract_address_testnet' => '0x3235981927E5Ba0283155a98A92c64381C4eB14B',
                'description' => 'Another set of Mustachio adventurers are joining the Pathfinders (2D and 3D Genesis Mustachios) and Marauders (Second Generation Mustachios) as they explore the Metaverse! Here comes the Mustachio Rascals, the next generation of our Mustachios. With a maximum supply of 10,000 Generated 3D NFTs, the Mustachio Rascals are the third generation of Mustachios. Of course, you may explore and play Mustachio Quest with your 3D Mustachio Rascal. Holders of these NFTs will also receive a reward of $OWN tokens for 4 quarters. And of course, these Mustachio Rascals will also have their own Augmented Reality soon!',
                'token_uri' => 'https://ownly.market/api/rascals/',
                'url_placeholder' => 'rascals'
            ]
        ];

        foreach($collectionInputs as $collectionInput) {
            $out->writeln('Collection: ' . $collectionInput['name']);

            $collection = Collection::where('chain_id', $collectionInput['chain_id'])
                ->where(function($where) use ($collectionInput) {
                    $where->where('contract_address', $collectionInput['contract_address']);
                    $where->orWhere('contract_address', $collectionInput['contract_address_testnet']);
                })
                ->where('url_placeholder', $collectionInput['url_placeholder'])
                ->first();

            if(!$collection) {
                $collection = new Collection();
            }

            $collection->contract_address = (config('app.env') == 'production') ? $collectionInput['contract_address'] : $collectionInput['contract_address_testnet'];
            $collection->chain_id = $collectionInput['chain_id'];
            $collection->name = $collectionInput['name'];
            $collection->description = $collectionInput['description'];
            $collection->token_uri = $collectionInput['token_uri'];
            $collection->url_placeholder = $collectionInput['url_placeholder'];

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

            $response = Http::get($explorers[$collection['chain_id']]['endpoint'] . '/api?module=contract&action=getabi&address=' . $collectionInput['contract_address'] . '&apikey=' . $explorers[$collection['chain_id']]['key']);

            if($response && $response['result']) {
                $collection->abi = $response['result'];
            }

            $collection->save();

            // Scan tokens with token uri
            $i = 0;
            while(true) {
                $endpoint = $collection['token_uri'] . $i;
                $response = Http::get($endpoint);

                if(isset($response['name'])) {
                    $out->writeln('Fetching from ' . $endpoint);

                    $token = Token::where('collection_id', $collection['id'])
                        ->where('token_id', $i)
                        ->first();

                    if(!$token) {
                        $token = new Token();
                    }

                    $token->collection_id = $collection['id'];
                    $token->token_id = $i;
                    $token->name = $response['name'];
                    $token->description = $response['description'];
                    $token->image = $response['image'];
                    $token->attributes = json_encode($response['attributes']);

                    // Create image versions of the token
                    $last = DB::table('tokens')->latest()->first();
                    $thumbnail['original'] = $token->image;
                    $thumbnail['jpg512'] = HelperController::resizeImage($last->id + 1, $token->image, 'jpg', '512');
                    $thumbnail['webp512'] = HelperController::resizeImage($last->id + 1, $token->image, 'webp', '512');
                    $thumbnail['webp256'] = HelperController::resizeImage($last->id + 1, $token->image, 'webp', '256');
                    $token->thumbnail = json_encode($thumbnail);

                    $token->save();
                } else {
                    break;
                }

                $i++;
            }
        }

        $out->writeln("Command Completed!");

        return 0;
    }
}
