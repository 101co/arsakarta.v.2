<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('assetmanm_asset_type', function (Blueprint $table) {
            $table->id();
            $table->string('asset_type', length:255);
            $table->boolean('is_active')->default(true);
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });

        Schema::create('assetmanm_asset', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name', length:255);
            $table->foreignId('asset_type_id')->constrained('assetmanm_asset_type');
            $table->string('asset_detail', length:1000);
            $table->boolean('is_active')->default(true);
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });

        Schema::create('assetmanm_asset_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_type_id')->constrained('assetmanm_asset_type');
            $table->string('asset_detail', length:255);
            $table->boolean('is_active')->default(true);
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('assetmanm_asset_type');
        Schema::dropIfExists('assetmanm_asset');
        Schema::dropIfExists('assetmanm_asset_detail');
    }
};
