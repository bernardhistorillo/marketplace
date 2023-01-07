<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenTransferIdToTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chen_ink_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('token_transfer_id')->default(0)->after('priority');
        });

        Schema::table('mustachios', function (Blueprint $table) {
            $table->unsignedBigInteger('token_transfer_id')->default(0)->after('exists');
        });

        Schema::table('rewards_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('token_transfer_id')->default(0)->after('supply');
        });

        Schema::table('titans_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('token_transfer_id')->default(0)->after('attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chen_ink_tokens', function (Blueprint $table) {
            $table->dropColumn('token_transfer_id');
        });

        Schema::table('mustachios', function (Blueprint $table) {
            $table->dropColumn('token_transfer_id');
        });

        Schema::table('rewards_tokens', function (Blueprint $table) {
            $table->dropColumn('token_transfer_id');
        });

        Schema::table('titans_tokens', function (Blueprint $table) {
            $table->dropColumn('token_transfer_id');
        });
    }
}
