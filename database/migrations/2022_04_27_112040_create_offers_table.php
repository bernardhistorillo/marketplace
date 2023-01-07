<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('chain_id');
            $table->string('contract_address');
            $table->integer('token_id');
            $table->string('owner');
            $table->string('offeror');
            $table->string('signature');
            $table->tinyInteger('verified')->default(0);
            $table->string('currency');
            $table->decimal('amount', 65, 18);
            $table->dateTime('date_time_offered');
            $table->integer('expiration');
            $table->dateTime('until');
            $table->dateTime('invalid')->nullable();
            $table->dateTime('cancelled')->nullable();
            $table->dateTime('accepted')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
