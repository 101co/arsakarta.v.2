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
        Schema::create('arskrtm_theme', function (Blueprint $table) {
            $table->id();
            $table->string('initial', length:5);
            $table->foreignId('theme_master_id')->constrained('arskrtm_theme_master');
            $table->foreignId('package_id')->constrained('arskrtm_package');
            $table->foreignId('event_category_id')->constrained('arskrtm_event_category');
            $table->string('image', length:255);
            $table->json('layouts');
            $table->boolean('is_show_demo')->default(false);
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
        Schema::dropIfExists('arskrtm_theme');
    }
};
