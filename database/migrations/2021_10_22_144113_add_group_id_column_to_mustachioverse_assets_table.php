<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdColumnToMustachioverseAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mustachioverse_assets', function (Blueprint $table) {
            $table->integer('group_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mustachioverse_assets', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
    }
}
