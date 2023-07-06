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
        Schema::table('users', function (Blueprint $table) {
            $table->string('net_worth')->nullable();
            $table->string('annual_income')->nullable();
            $table->boolean('are_you_accredited');
            $table->boolean('afford_loss');
            $table->boolean('understand_securities');
            $table->boolean('investment_advice');
            $table->boolean('agree_policy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
