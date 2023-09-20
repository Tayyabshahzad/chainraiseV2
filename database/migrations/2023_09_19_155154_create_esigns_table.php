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
        Schema::create('esigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');

            $table->unsignedBigInteger('issuer_id');
            $table->foreign('issuer_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('invester_id');
            $table->foreign('invester_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('template_id')->nullable();
            $table->text('template_name')->nullable();
            $table->text('status')->nullable();

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
        Schema::dropIfExists('esigns');
    }
};
