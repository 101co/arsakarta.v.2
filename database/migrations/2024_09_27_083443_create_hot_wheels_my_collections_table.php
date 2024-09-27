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
        Schema::create('hot_wheels_my_collections', function (Blueprint $table) {
            $table->id();
            $table->string('sku', length:5);
            $table->string('color', length:50);
            $table->string('images', length:500);
            $table->integer('year');
            $table->string('name', length:50);
            $table->integer('buy_price');
            $table->integer('sell_price');
            $table->foreignId('hot_wheels_car_brand_id')->constrained('hot_wheels_car_brands');
            $table->foreignId('hot_wheels_type_id')->constrained('hot_wheels_types');
            $table->foreignId('hot_wheels_lot_id')->constrained('hot_wheels_lots');
            $table->foreignId('hot_wheels_seri_id')->constrained('hot_wheels_seris');
            $table->boolean('is_owned')->default(false);
            $table->date('owned_date')->nullable();
            $table->date('sell_date')->nullable();
            $table->boolean('is_to_be_hunted')->default(false);
            $table->boolean('is_loosed')->default(false);
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
        Schema::dropIfExists('hot_wheels_my_collections');
    }
};
