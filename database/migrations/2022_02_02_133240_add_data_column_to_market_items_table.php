<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataColumnToMarketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('market_items', function (Blueprint $table) {
            $table->json('event')->after('signature');
            $table->renameColumn('message', 'message_hash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('market_items', function (Blueprint $table) {
            $table->dropColumn('event');
            $table->renameColumn('message_hash', 'message');
        });
    }
}
