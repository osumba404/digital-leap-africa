<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
        {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('content');
                $table->text('excerpt')->nullable();
                $table->string('featured_image')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
                $table->foreignId('author_id')->constrained('users');
                $table->timestamps();
                //$table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            });
        }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
