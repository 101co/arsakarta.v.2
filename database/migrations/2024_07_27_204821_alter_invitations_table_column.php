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
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('event_name', length:100);
            $table->string('slug', length:255);
            $table->foreignId('selected_event_type_id')->constrained('event_types');
            $table->foreignId('selected_song_id')->constrained('songs');
            $table->foreignId('selected_theme_id')->constrained('themes');
            $table->foreignId('selected_package_id')->constrained('packages');
            $table->boolean('is_active')->default(true);
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
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
