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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('account_id')->unique();
            $table->string('password');
            $table->string('phone_no');            
            $table->double('account_bal', 50, 10);
            $table->string('email_verified');
            $table->string('status'); 
            $table->string('street_address');
            $table->string('state');
            $table->string('country');
            $table->string('referred_by')->nullable(); 
            $table->string('2fa')->default('disabled');           
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_picture');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
