<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            // Allow arrays encoded as JSON
            $table->longText('resource_url')->nullable()->change();
            $table->longText('attachment_path')->nullable()->change();
            // You already have code_snippet longtext; keep it as is
            // $table->longText('code_snippet')->nullable()->change();
        });
    }
    
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            // Revert to varchar(255) if needed (be aware of truncation risk)
            $table->string('resource_url', 255)->nullable()->change();
            $table->string('attachment_path', 255)->nullable()->change();
        });
    }
};
