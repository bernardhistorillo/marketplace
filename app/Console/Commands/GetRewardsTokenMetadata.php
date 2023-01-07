<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\Mustachio;
use App\RewardsToken;
use App\TitansToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class GetRewardsTokenMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:get_rewards_token_metadata';

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

        $opensea = [
            'https://storage.opensea.io/files/1ee326fe327c295a3913e2bc22403831.mp4#t=0.001',
            'https://storage.opensea.io/files/3c12d8cbdf43cd9641687759cf75526f.mp4#t=0.001',
            'https://storage.opensea.io/files/a18ce0fde4988a6101fc424981b0acdb.mp4#t=0.001',
            'https://storage.opensea.io/files/f5440dd321438d05066624b22e7f0a05.mp4#t=0.001',
            'https://storage.opensea.io/files/25b451ba13da0c6cd6d117beb76d61d1.mp4#t=0.001',
            'https://storage.opensea.io/files/c1fe46e46705ac7953643a0860f5665e.mp4#t=0.001',
            'https://storage.opensea.io/files/df5c01986f1e193823cc035f205e9537.mp4#t=0.001',
            'https://storage.opensea.io/files/44c42b2a4c8c8a4b1d717f4bdcf9e81b.mp4#t=0.001',
            'https://storage.opensea.io/files/e6c6f300cb032bf6972dab05afe3bf2a.mp4#t=0.001',
            'https://ownly.market/nft/rewards/rewards-0010.webp',
            'https://ownly.market/nft/rewards/rewards-0011.webp',
        ];

        $supplies = [5, 120, 17, 1, 1, 1, 1, 1, 1, 1, 1];

        $i = 1;
        while(true) {
            $out->writeln('Fetching from https://ownly.io/nft/rewards/api/' . $i . '/?v=' . date('YmdHis'));

            $response = Http::get('https://ownly.io/nft/rewards/api/' . $i . '/?v=' . date('YmdHis'));

            if(isset($response['name'])) {
                $rewards_token = RewardsToken::find($i);

                if(!$rewards_token) {
                    $rewards_token = new RewardsToken();
                }

                $id = $i;

                while(strlen($id) < 4) {
                    $id = '0' . $id;
                }

                $rewards_token->name = $response['name'];
                $rewards_token->description = $response['description'];
                $rewards_token->image = $response['image'];
                $rewards_token->attributes = json_encode($response['attributes']);
                $rewards_token->supply = $supplies[$i - 1];

                if(isset($opensea[$i - 1]) && $opensea[$i - 1]) {
                    $rewards_token->thumbnail = $opensea[$i - 1];
                } else {
                    $extension = '.mp4';

                    if($i == 10) {
                        $extension = '.png';
                    }

                    if($i == 11) {
                        $extension = '.jpg';
                    }

                    $rewards_token->thumbnail = 'https://ownly.market/nft/rewards/rewards-' . $id . $extension;
                }

                $rewards_token->save();
            } else {
                break;
            }

            $i++;
        }

        $out->writeln("Command Completed!");
    }
}
