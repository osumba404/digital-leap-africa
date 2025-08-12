<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            // Each lesson must belong to a topic.
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('type')->default('note'); // 'note', 'video', 'assignment', 'quiz'
            $table->text('content')->nullable(); // For notes or assignment details
            $table->string('video_url')->nullable(); // For video lessons
            $table->string('resource_url')->nullable(); // For downloadable PDFs, etc.
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};