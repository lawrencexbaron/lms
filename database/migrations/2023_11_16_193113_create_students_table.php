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
            // add student number with unique and randomize
            $table->string('student_number')->unique()->nullable();
            $table->string('lrn')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('student_type',['new','old', 'transferee', 'balik_aral'])->default('new');
            $table->enum('gender', ['male', 'female']);
            $table->string('psa_no')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('previous_sy_attended')->nullable();
            $table->string('previous_level')->nullable();
            $table->string('previous_section')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('gwa')->nullable();
            $table->json('learning_modules')->nullable();
            $table->string('learner_status')->nullable();
            $table->string('last_school_attended')->nullable();
            $table->foreignId('section_id')->nullable()->constrained('sections')->cascadeOnDelete();
            $table->foreignId('grade_level_id')->nullable()->constrained('grades')->cascadeOnDelete();
            $table->foreignId('school_year_id')->nullable()->constrained('school_years')->cascadeOnDelete();
            $table->foreignId('address_id')->nullable()->constrained('addresses')->cascadeOnDelete();
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
