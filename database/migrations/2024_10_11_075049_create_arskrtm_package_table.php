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
        Schema::create('arskrtm_package', function (Blueprint $table) {
            $table->id();
            $table->string('initial', length:5);
            $table->string('name',  length:25);
            $table->integer('price');
            $table->json('detail');
            $table->boolean('is_trial')->default(false);
            $table->boolean('is_active');
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arskrtm_package');
    }
};
