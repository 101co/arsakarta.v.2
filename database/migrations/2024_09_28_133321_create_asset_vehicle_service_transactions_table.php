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
        Schema::create('asset_vehicle_service_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets');
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
    public function down(): void
    {
        Schema::dropIfExists('asset_vehicle_service_transactions');
    }
};
