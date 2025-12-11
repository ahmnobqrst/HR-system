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
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_number')->unique()->nullable();
            $table->string('address');
            $table->string('phone');
            $table->integer('age');
            $table->string('gender');
            $table->string('job_title');
            $table->date('birthdate');
            $table->integer('salary')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('work_schedule_id')->nullable()->constrained('work_schedules')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
