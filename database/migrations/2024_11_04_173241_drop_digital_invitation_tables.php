<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::dropIfExists('arskrtm_layout_theme_page');
        Schema::dropIfExists('arskrtm_theme_master');
        Schema::dropIfExists('arskrtm_theme_category');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
    }
};
