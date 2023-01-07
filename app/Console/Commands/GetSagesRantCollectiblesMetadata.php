<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\GenesisBlockToken;
use App\Mustachio;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class GetSagesRantCollectiblesMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:get_sages_rant_collectibles_metadata';

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
            $out->writeln('Fetching from https://ownly.io/nft/the-sages-rant-collectibles/api/' . $i . '/?v=' . date('YmdHis'));

            $response = Http::get('https://ownlyio.github.io/nft/the-sages-rant-collectibles/api/' . $i . '/?v=' . date('YmdHis'));

            if(isset($response['name'])) {
                $sages_rant_collectible = SagesRantCollectible::find($i);

                if(!$sages_rant_collectible) {
                    $sages_rant_collectible = new SagesRantCollectible();
                }

                $sages_rant_collectible->name = $response['name'];
                $sages_rant_collectible->description = $response['description'];
                $sages_rant_collectible->image = $response['image'];
                $sages_rant_collectible->attributes = json_encode($response['attributes']);
                $sages_rant_collectible->thumbnail = 'https://ownly.market/nft/the-sages-rant-collectibles/' . $i . '.webp';

                $sages_rant_collectible->save();
            } else {
                break;
            }

            $i++;
        }

        $out->writeln("Command Completed!");
    }
}
