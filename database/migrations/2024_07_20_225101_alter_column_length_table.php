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
        Schema::table('event_type_layouts', function (Blueprint $table) {
            $table->string('layouts',5000)->change();
        });
        Schema::table('package_features', function (Blueprint $table) {
            $table->string('features',5000)->change();
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
