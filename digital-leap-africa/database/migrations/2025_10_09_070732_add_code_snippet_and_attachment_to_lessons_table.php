<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->longText('code_snippet')->nullable()->after('content'); // adjust 'content' to an existing column
            $table->string('attachment_path')->nullable()->after('code_snippet'); // store image/slide/pdf path
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn(['code_snippet', 'attachment_path']);
        });
    }
};