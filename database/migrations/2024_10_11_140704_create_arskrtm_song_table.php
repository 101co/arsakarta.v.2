<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('arskrtm_song', function (Blueprint $table) {
            $table->id();
            $table->string('title', length:100);
            $table->string('artist', length:50);
            $table->string('filename', length:255);
            $table->foreignId('event_category_id')->constrained('arskrtm_event_category');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_for_all')->default(true);
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
        Schema::dropIfExists('arskrtm_song');
    }
};
