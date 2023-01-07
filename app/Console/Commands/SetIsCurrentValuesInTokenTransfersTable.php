<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\GenesisBlockToken;
use App\Mustachio;
use App\RewardsToken;
use App\SagesRantCollectible;
use App\TitansToken;
use App\TokenTransfer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class SetIsCurrentValuesInTokenTransfersTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:set_is_current_values_in_token_transfers_table';

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

        TokenTransfer::where('id', '>', 0)
            ->update([
                'is_current' => 0
            ]);

        $token_transfers = TokenTransfer::get();

        foreach($token_transfers as $token_transfer) {
            $out->writeln('ID: ' . $token_transfer['id']);

            $previous_token_transfer = TokenTransfer::where('contract_address', $token_transfer['contract_address'])
                ->where('token_id', $token_transfer['token_id'])
                ->where('from', $token_transfer['to'])
                ->where('signed_at', '<', $token_transfer['signed_at'])
                ->first();

            $out->writeln($previous_token_transfer);

            if(!$previous_token_transfer) {
                $token_transfer->is_current = 1;
                $token_transfer->update();
            }
        }

        $out->writeln("Command Completed!");
    }
}
