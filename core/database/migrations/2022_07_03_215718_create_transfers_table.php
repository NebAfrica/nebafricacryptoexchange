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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('amount');
            $table->string('fee');
            $table->string('total');
            $table->string('status');
            $table->string('txn_id');
            $table->string('narration');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
        DB::statement(
            "ALTER TABLE transfers ADD FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
};
