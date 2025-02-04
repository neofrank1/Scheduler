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
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->text('address');
            $table->string('mobile_no')->nullable();
            $table->integer('education_id');
            $table->integer('ranking_id');
            $table->foreignId('college_id')->nullable()->constrained('college');
            $table->foreignId('course_id')->nullable()->constrained('course');
            $table->float('maximum_hours');
            $table->integer('employee_status');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
