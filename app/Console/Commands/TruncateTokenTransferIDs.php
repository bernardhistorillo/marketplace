<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\GenesisBlockToken;
use App\Mustachio;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class TruncateTokenTransferIDs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:truncate_token_transfer_ids';

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

        DB::table('token_transfers')->truncate();

        ChenInkToken::where('token_transfer_id', '!=', 0)
            ->update([
                'token_transfer_id' => 0
            ]);
        $out->writeln("ChenInkToken -> Success");

        GenesisBlockToken::where('token_transfer_id', '!=', 0)
            ->update([
                'token_transfer_id' => 0
            ]);
        $out->writeln("GenesisBlockToken -> Success");

        Mustachio::where('token_transfer_id', '!=', 0)
            ->update([
                'token_transfer_id' => 0
            ]);
        $out->writeln("Mustachio -> Success");

        RewardsToken::where('token_transfer_id', '!=', 0)
            ->update([
                'token_transfer_id' => 0
            ]);
        $out->writeln("RewardsToken -> Success");

        SagesRantCollectible::where('token_transfer_id', '!=', 0)
            ->update([
                'token_transfer_id' => 0
            ]);
        $out->writeln("SagesRantCollectible -> Success");

        TitansToken::where('token_transfer_id', '!=', 0)
            ->update([
                'token_transfer_id' => 0
            ]);
        $out->writeln("TitansToken -> Success");

        $out->writeln("Command Completed!");
    }
}
