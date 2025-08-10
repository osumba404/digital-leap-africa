<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gamification_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('points');
            $table->string('action'); // e.g., 'course_completion', 'post_creation'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gamification_points');
    }
};