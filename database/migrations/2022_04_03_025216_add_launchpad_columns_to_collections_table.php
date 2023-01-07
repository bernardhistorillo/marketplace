<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaunchpadColumnsToCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->string('owner')->after('is_curated');
            $table->tinyInteger('is_active')->default(0)->after('is_curated');
            $table->text('properties')->after('is_curated');
            $table->tinyInteger('is_launchpad_collection')->default(0)->after('is_curated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('properties');
            $table->dropColumn('is_launchpad_collection');
        });
    }
}
