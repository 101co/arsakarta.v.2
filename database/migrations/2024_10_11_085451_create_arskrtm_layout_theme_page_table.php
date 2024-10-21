<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('arskrtm_layout_theme_page', function (Blueprint $table) {
            $table->id();
            $table->string('initial', length:6);
            $table->string('name',  length:50);
            $table->string('page_name',  length:255)->nullable();
            $table->foreignId('theme_master_id')->constrained('arskrtm_theme_master');
            $table->foreignId('layout_id')->constrained('arskrtm_layout');
            $table->boolean('is_active');
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('arskrtm_layout_theme_page');
    }
};
