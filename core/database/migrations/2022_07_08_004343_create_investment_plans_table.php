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
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount_type'); //fixed or range
            $table->string('min_amount');
            $table->string('max_amount');
            $table->string('return_type'); //fixed or Roi
            $table->string('return');
            $table->string('duration');
            $table->string('duration_type'); //hour, day, week, month , year
            $table->string('return_interval'); //hourly, daily, weekly, monthly, yearly
            $table->string('status');
            $table->string('label')->nullable();
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
        Schema::dropIfExists('investment_plans');
    }
};
