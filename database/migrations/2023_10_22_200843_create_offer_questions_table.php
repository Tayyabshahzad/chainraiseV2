<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_questions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->unsignedBigInteger('investor_id');
            $table->foreign('investor_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('issuer_id')->nullable();
            $table->foreign('issuer_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->enum('status',['active','inactive']);


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
        Schema::dropIfExists('offer_questions');
    }
};
