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
        Schema::table('arskrtm_theme', function (Blueprint $table) {
            $table->dropForeign('arskrtm_theme_theme_master_id_foreign');
            $table->dropColumn('theme_master_id');
            $table->string('theme', length:255);
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
