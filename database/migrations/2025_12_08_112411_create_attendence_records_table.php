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
        Schema::create('attendence_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->dateTime('checkIn')->nullable();
            $table->dateTime('checkOut')->nullable();
            $table->decimal('delay_hours', 8, 2)->nullable();
            $table->decimal('early_leave_hours', 8, 2)->nullable();
            $table->decimal('worked_hours', 8, 2)->nullable();
            $table->decimal('over_time', 8, 2)->nullable();
            $table->string('status')->default('present');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendence_records');
    }
};
