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
        Schema::create('section', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('year_lvl');
            $table->foreignId('college_id')->nullable()->constrained('college');
            $table->foreignId('course_id')->nullable()->constrained('course');
            $table->integer('program');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section');
    }
};
