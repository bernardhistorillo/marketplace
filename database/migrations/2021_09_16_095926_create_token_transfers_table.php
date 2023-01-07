<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('chain_id');
            $table->string('contract_address');
            $table->integer('token_id');
            $table->string('from');
            $table->string('to');
            $table->decimal('value', 65, 18)->default(0);
            $table->string('currency')->nullable();
            $table->string('transaction_hash');
            $table->dateTime('signed_at');
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
        Schema::dropIfExists('token_transfers');
    }
}
