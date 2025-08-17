<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // BIGINT AUTO_INCREMENT
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('date')->index(); // index for faster queries
            $table->string('location')->nullable();
            $table->string('rsvp_url', 500)->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
