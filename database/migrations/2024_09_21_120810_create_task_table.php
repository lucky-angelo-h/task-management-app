<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->string('task_description');
            $table->foreignId('category_id')->nullable();
            $table->foreignId('status_id')->default(1);
            $table->timestamp('completion_date');
            $table->timestamps();
        });

        Schema::create('member_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->index();
            $table->foreignId('task_id')->index();
        });

        Schema::create('task_category', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->index();
        });

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('system_activity', function (Blueprint $table) {
            $table->id();
            $table->string('activity_type');
            $table->string('resource_type');
            $table->foreignId('resource_id');
            $table->timestamp('activity_timestamp');
        });

        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('member_tasks');
        Schema::dropIfExists('task_category');
        Schema::dropIfExists('members');
        Schema::dropIfExists('system_activity');
        Schema::dropIfExists('task_statuses');
    }
};
