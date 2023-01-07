<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\GenesisBlockToken;
use App\Mustachio;
use App\RewardsToken;
use App\TitansToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class GetGenesisBlockTokenMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:get_genesis_block_token_metadata';

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

        $i = 1;
        while(true) {
            $out->writeln('Fetching from https://ownly.io/nft/genesis-block/api/' . $i . '/?v=' . date('YmdHis'));

            $response = Http::get('https://ownlyio.github.io/nft/genesis-block/api/' . $i . '/?v=' . date('YmdHis'));

            if(isset($response['name'])) {
                $genesis_block_token = GenesisBlockToken::find($i);

                if(!$genesis_block_token) {
                    $genesis_block_token = new GenesisBlockToken();
                }

                $genesis_block_token->name = $response['name'];
                $genesis_block_token->description = $response['description'];
                $genesis_block_token->image = $response['image'];
                $genesis_block_token->attributes = json_encode($response['attributes']);

                // caching
                $name = $i;
                if(in_array($name, [5, 6])) {
                    $name = $name . '-1';
                }

                $genesis_block_token->thumbnail = 'https://ownly.market/nft/genesis-block/' . $name . '.webp';

                $genesis_block_token->save();
            } else {
                break;
            }

            $i++;
        }

        $out->writeln("Command Completed!");
    }
}
