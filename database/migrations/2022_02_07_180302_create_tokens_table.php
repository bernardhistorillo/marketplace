<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('collection_id');
            $table->string('token_id');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->string('thumbnail');
            $table->json('attributes');
            $table->unsignedBigInteger('token_transfer_id')->default(0);
            $table->string('trans_bg')->nullable();
            $table->integer('priority')->default(0);
            $table->integer('supply')->default(1);
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
        Schema::dropIfExists('tokens');
    }
}
