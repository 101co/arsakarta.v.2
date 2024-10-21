<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('sysmans_role_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('sysmanm_role');
            $table->foreignId('menu_id')->constrained('sysmanm_menu');
            $table->string('created_by', length: 50);
            $table->string('updated_by', length: 50);
            $table->timestamps();
        });

        Schema::create('sysmans_role_menu_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_menu_id')->constrained('sysmans_role_menu');
            $table->foreignId('menu_id')->constrained('sysmanm_menu');
            $table->string('created_by', length: 50);
            $table->string('updated_by', length: 50);
            $table->timestamps();
        });
        
        Schema::create('sysmans_role_menu_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_menu_id')->constrained('sysmans_role_menu');
            $table->foreignId('user_id')->constrained('users');
            $table->string('created_by', length: 50);
            $table->string('updated_by', length: 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sysmans_role_menu');
        Schema::dropIfExists('sysmans_role_menu_detail');
        Schema::dropIfExists('sysmans_role_menu_user');
    }
};
