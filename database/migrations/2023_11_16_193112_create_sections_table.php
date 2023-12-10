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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('capacity')->default(0);
            $table->foreignId('adviser_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('grade_level_id')->nullabe()->constrained('grades')->onDelete('cascade');
            $table->foreignId('school_year_id')->nullabe()->constrained('school_years')->onDelete('cascade');
            $table->foreignId('room_id')->nullabe()->constrained('rooms')->onDelete('cascade');
            $table->string('section_code');
            $table->string('section_description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
