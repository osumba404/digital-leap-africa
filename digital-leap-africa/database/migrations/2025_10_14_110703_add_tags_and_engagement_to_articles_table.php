<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // tags: JSON array of strings
            if (!Schema::hasColumn('articles', 'tags')) {
                $table->json('tags')->nullable()->after('excerpt');
            }

            // engagement counters
            if (!Schema::hasColumn('articles', 'likes_count')) {
                $table->unsignedBigInteger('likes_count')->default(0)->after('tags');
            }
            if (!Schema::hasColumn('articles', 'bookmarks_count')) {
                $table->unsignedBigInteger('bookmarks_count')->default(0)->after('likes_count');
            }
            if (!Schema::hasColumn('articles', 'shares_count')) {
                $table->unsignedBigInteger('shares_count')->default(0)->after('bookmarks_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'shares_count')) {
                $table->dropColumn('shares_count');
            }
            if (Schema::hasColumn('articles', 'bookmarks_count')) {
                $table->dropColumn('bookmarks_count');
            }
            if (Schema::hasColumn('articles', 'likes_count')) {
                $table->dropColumn('likes_count');
            }
            if (Schema::hasColumn('articles', 'tags')) {
                $table->dropColumn('tags');
            }
        });
    }
};