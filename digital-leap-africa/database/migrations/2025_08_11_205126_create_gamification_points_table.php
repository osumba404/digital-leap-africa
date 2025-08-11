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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('points');
            $table->string('reason'); // e.g., "Course Enrollment", "Commented on Forum"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gamification_points');
    }
};