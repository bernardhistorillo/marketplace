<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\GenesisBlockToken;
use App\Mustachio;
use App\OhaToken;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class GetOhaTokensMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:get_oha_tokens_metadata';

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
            $out->writeln('Fetching from https://ownly.io/nft/oha/api/' . $i . '/?v=' . date('YmdHis'));

            $response = Http::get('https://ownlyio.github.io/nft/oha/api/' . $i . '/?v=' . date('YmdHis'));

            if(isset($response['name'])) {
                $ohaToken = OhaToken::find($i);

                if(!$ohaToken) {
                    $ohaToken = new OhaToken();
                }

                $ohaToken->name = $response['name'];
                $ohaToken->description = $response['description'];
                $ohaToken->image = $response['image'];
                $ohaToken->attributes = json_encode($response['attributes']);
                $ohaToken->thumbnail = 'https://ownly.market/nft/oha/' . $i . '.webp';

                $ohaToken->save();
            } else {
                break;
            }

            $i++;
        }

        $out->writeln("Command Completed!");
    }
}
