<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hot_wheels_my_collections', function (Blueprint $table) 
        {
            $table->string('color', length:50)->nullable()->change();
            $table->string('images', length:500)->nullable()->change();
            $table->integer('sell_price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
