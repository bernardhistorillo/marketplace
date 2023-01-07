<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgeClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badge_claims', function (Blueprint $table) {
            $table->id();
            $table->string('twitter_id');
            $table->string('twitter_details');
            $table->tinyInteger('followed_ownly')->default(0);
            $table->tinyInteger('followed_mustachioverse')->default(0);
            $table->string('address')->nullable();
            $table->string('signature')->nullable();
            $table->string('transaction_hash')->nullable();
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
        Schema::dropIfExists('badge_claims');
    }
}
