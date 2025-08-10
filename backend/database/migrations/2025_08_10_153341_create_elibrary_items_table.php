<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('elibrary_items', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('type'); // e.g., 'eBook', 'Video', 'Toolkit'
        $table->string('file_path');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elibrary_items');
    }
};
