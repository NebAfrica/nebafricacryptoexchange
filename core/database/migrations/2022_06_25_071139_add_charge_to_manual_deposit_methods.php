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
        Schema::table('manual_deposit_methods', function (Blueprint $table) {
            $table->string('charge')->after('max_amount')->default(5);
            $table->string('charge_type')->after('charge')->default('percent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manual_deposit_methods', function (Blueprint $table) {
            $table->dropColumn('charge');
            $table->dropColumn('charge_type');
        });
    }
};
