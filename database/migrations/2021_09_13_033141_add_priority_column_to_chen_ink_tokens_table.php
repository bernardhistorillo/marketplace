<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriorityColumnToChenInkTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chen_ink_tokens', function (Blueprint $table) {
            $table->integer('priority')->default(0)->after('attributes');
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
            $table->dropColumn('priority');
        });
    }
}
