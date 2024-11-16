<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('arskrtt_invitation_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained('arskrtt_invitation');
            $table->foreignId('package_id')->constrained('arskrtm_package');
            $table->string('order_id', length:255)->nullable(true);
            $table->boolean('is_paid')->default(false);
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
        Schema::dropIfExists('invitation_payments');
    }
};
