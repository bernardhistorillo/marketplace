<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestOneRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quest_one_rewards', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('private_key');
            $table->string('holder')->nullable();
            $table->integer('token_id')->nullable();
            $table->dateTime('date_accessed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quest_one_rewards');
    }
}
