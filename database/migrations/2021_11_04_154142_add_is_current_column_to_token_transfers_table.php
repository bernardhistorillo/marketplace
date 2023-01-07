<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCurrentColumnToTokenTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('token_transfers', function (Blueprint $table) {
            $table->tinyInteger('is_current')->default(0)->after('signed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('token_transfers', function (Blueprint $table) {
            $table->dropColumn('is_current');
        });
    }
}
