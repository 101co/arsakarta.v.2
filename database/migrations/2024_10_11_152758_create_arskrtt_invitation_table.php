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
        Schema::create('arskrtt_invitation', function (Blueprint $table) {
            $table->id();
            $table->string('name', length:100);
            $table->string('slug', length:255);
            $table->foreignId('event_category_id')->constrained('arskrtm_event_category');
            $table->foreignId('package_id')->constrained('arskrtm_package');
            $table->foreignId('theme_id')->constrained('arskrtm_theme');
            $table->foreignId('song_id')->constrained('arskrtm_song');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_paid')->default(true);
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
        Schema::dropIfExists('arskrtt_invitation');
    }
};
