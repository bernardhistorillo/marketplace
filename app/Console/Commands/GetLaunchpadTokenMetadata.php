<?php

namespace App\Console\Commands;

use App\LaunchpadToken;
use App\TitansToken;
use App\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class GetLaunchpadTokenMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:get_launchpad_token_metadata';

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

        $collection_id = 11;

        $i = 1;
        while(true) {
            $out->writeln('Fetching from https://ownly.io/nft/sample/api/' . $i . '/?v=' . date('YmdHis'));

            $response = Http::get('https://ownly.io/nft/sample/api/' . $i . '/?v=' . date('YmdHis'));

            if(isset($response['name'])) {
                $token = Token::where('collection_id', $collection_id)
                    ->where('token_id', $i)
                    ->first();

                if(!$token) {
                    $token = new Token();
                }

                $token->collection_id = $collection_id;
                $token->token_id = $i;
                $token->name = $response['name'];
                $token->description = $response['description'];
                $token->image = $response['image'];
                $token->thumbnail = $response['image'];
                $token->attributes = json_encode($response['attributes']);
                $token->token_transfer_id = 0;
                $token->trans_bg = '';
                $token->priority = 0;
                $token->supply = 1;
                $token->save();
            } else {
                break;
            }

            $i++;
        }

        $out->writeln("Command Completed!");
    }
}
