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
        Schema::create('sysmanm_module', function (Blueprint $table) {
            $table->id();
            $table->string('description', length:255);
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });

        Schema::create('sysmanm_application', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('sysmanm_module');
            $table->string('name', length:100);
            $table->string('description', length:255);
            $table->string('created_by', length:50);
            $table->string('updated_by', length:50);
            $table->timestamps();
        });
        
        Schema::create('sysmanm_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('sysmanm_application');
            $table->string('code', length: 10);
            $table->string('description', length: 255);
            $table->string('created_by', length: 50);
            $table->string('updated_by', length: 50);
            $table->timestamps();
        });
        
        Schema::create('sysmanm_role', function (Blueprint $table) {
            $table->id();
            $table->string('role', length: 100);
            $table->string('description', length: 255);
            $table->string('created_by', length: 50);
            $table->string('updated_by', length: 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sysmanm_module');
        Schema::dropIfExists('sysmanm_application');
        Schema::dropIfExists('sysmanm_menu');
        Schema::dropIfExists('sysmanm_role');
    }
};
