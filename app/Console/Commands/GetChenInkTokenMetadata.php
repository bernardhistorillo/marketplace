<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\Mustachio;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class GetChenInkTokenMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:get_chen_ink_token_metadata';

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
            $out->writeln('Fetching from https://ownly.io/nft/api/' . $i . '/?v=' . date('YmdHis'));

            $response = Http::get('https://ownly.io/nft/api/' . $i . '/?v=' . date('YmdHis'));

            if(isset($response['name'])) {
                $chen_ink_token = ChenInkToken::find($i);

                if(!$chen_ink_token) {
                    $chen_ink_token = new ChenInkToken();
                }

                $id = $i;

                while(strlen($id) < 4) {
                    $id = '0' . $id;
                }

                $chen_ink_token->name = $response['name'];
                $chen_ink_token->description = $response['description'];
                $chen_ink_token->image = $response['image'];
                $chen_ink_token->attributes = json_encode($response['attributes']);
                $chen_ink_token->thumbnail = 'https://ownly.io/nft/collection/collection-' . $id . '.png';
                $chen_ink_token->save();
            } else {
                break;
            }

            $i++;
        }

        $priorities = [43, 42, 41, 30, 29, 28, 17, 16, 15, 4, 3, 2];

        foreach($priorities as $i => $priority) {
            $out->writeln("Prioritizing CryptoSolitaire Token " . $priority);

            $chen_ink_token = ChenInkToken::find($priority);
            $chen_ink_token->priority = $i + 1;
            $chen_ink_token->update();
        }

        $out->writeln("Command Completed!");
    }
}
