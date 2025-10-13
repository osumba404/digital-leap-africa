<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('about_sections', 'bullet_points')) {
                $table->json('bullet_points')->nullable()->after('read_more_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            if (Schema::hasColumn('about_sections', 'bullet_points')) {
                $table->dropColumn('bullet_points');
            }
        });
    }
};