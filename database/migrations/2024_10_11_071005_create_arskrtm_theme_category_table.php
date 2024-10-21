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
        Schema::create('arskrtm_theme_category', function (Blueprint $table) {
            $table->id();
            $table->string('initial', length:5);
            $table->string('name',  length:50);
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
        Schema::dropIfExists('arskrtm_theme_category');
    }
};
