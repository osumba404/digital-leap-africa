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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained()->onDelete('cascade'); // Only for post_lesson type
            $table->enum('type', ['pre_course', 'post_lesson', 'final']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_enabled')->default(true); // Instructor toggle - add exam or not
            $table->unsignedInteger('time_limit_minutes')->nullable(); // Optional time limit
            $table->boolean('count_towards_final_grade')->default(true); // false for pre_course
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->index(['course_id', 'type']);
            $table->index(['lesson_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
