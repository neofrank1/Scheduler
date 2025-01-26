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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId(column: 'room_id')->nullable()->constrained('rooms');
            $table->foreignId(column: 'prof_id')->nullable()->constrained('professors');
            $table->foreignId(column: 'subject_id')->nullable()->constrained('subjects');
            $table->foreignId(column: 'section_id')->nullable()->constrained('section');
            $table->foreignId(column: 'course_id')->nullable()->constrained('course');
            $table->string('school_yr', 255);
            $table->string('semester', 255);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
