<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\Mustachio;
use App\TitansToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class GetTitansTokenMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:get_titans_token_metadata';

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
            $out->writeln('Fetching from https://ownly.io/nft/titans-of-industry/api/' . $i . '/?v=' . date('YmdHis'));

            $response = Http::get('https://ownly.io/nft/titans-of-industry/api/' . $i . '/?v=' . date('YmdHis'));

            if(isset($response['name'])) {
                $titan_token = TitansToken::find($i);

                if(!$titan_token) {
                    $titan_token = new TitansToken();
                }

                $id = $i;

                while(strlen($id) < 4) {
                    $id = '0' . $id;
                }

                $titan_token->name = $response['name'];
                $titan_token->description = $response['description'];
                $titan_token->image = $response['asset'];
                $titan_token->attributes = json_encode($response['attributes']);
                $titan_token->thumbnail = $response['image'];
                $titan_token->save();
            } else {
                break;
            }

            $i++;
        }

        $out->writeln("Command Completed!");
    }
}
