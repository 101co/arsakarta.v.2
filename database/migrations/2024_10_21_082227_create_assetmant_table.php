<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('assetmant_pajak_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assetmanm_asset');
            $table->date('tanggal_pajak');
            $table->date('tanggal_pajak_selanjutnya');
            $table->boolean('is_pajak_tahunan')->default(true);
            $table->string('notes', length:1000)->nullable();
            $table->integer('amount')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });

        Schema::create('assetmant_vehicle_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assetmanm_asset');
            $table->date('service_date');
            $table->integer('current_odometer');
            $table->integer('next_odometer');
            $table->integer('price');
            $table->string('images', length:255)->nullable();
            $table->string('service_location', length:100)->nullable();
            $table->string('service_details', length:255)->nullable();
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
        Schema::dropIfExists('assetmant_pajak_kendaraan');
        Schema::dropIfExists('assetmant_vehicle_service');
    }
};
