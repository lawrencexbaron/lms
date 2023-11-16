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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('student_type',['new','old', 'transferee', 'balik-aral'])->default('new');
            $table->enum('gender', ['male', 'female']);
            $table->string('place_of_birth')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('last_sy_attended')->nullable();
            $table->string('last_school_attended')->nullable();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('grade_level_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('school_year_id')->constrained('school_years')->cascadeOnDelete();
            $table->foreignId('address_id')->constrained('addresses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
