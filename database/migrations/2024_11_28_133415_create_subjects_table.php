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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subj_code');
            $table->string('subj_desc');
            $table->string('subj_prereq');
            $table->integer('subj_type');
            $table->float('subj_lec_hours', 5, 1);
            $table->float('subj_lab_hours', 5, 1);
            $table->float('subj_hours', 5, 1);
            $table->integer('subj_units');
            $table->foreignId(column: 'course_id')->nullable()->constrained('course');
            $table->integer('semester');
            $table->string('school_year');
            $table->integer('year_level');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
