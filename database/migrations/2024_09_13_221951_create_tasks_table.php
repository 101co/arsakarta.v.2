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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('description', length:255);
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('task_type_id')->constrained('task_types');
            $table->string('status', length:100);
            $table->timestamp('plan_start_date')->nullable()->useCurrent();
            $table->timestamp('plan_end_date')->nullable();
            $table->integer('plan_hours')->nullable();
            $table->timestamp('actual_start_date')->nullable();
            $table->timestamp('actual_end_date')->nullable();
            $table->integer('actual_hours')->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
