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
        Schema::table('articles', function (Blueprint $table) {
            // Add tags column if it doesn't exist
            if (!Schema::hasColumn('articles', 'tags')) {
                $table->json('tags')->nullable();
            }
            
            // Add engagement columns if they don't exist
            if (!Schema::hasColumn('articles', 'likes_count')) {
                $table->integer('likes_count')->default(0);
            }
            
            if (!Schema::hasColumn('articles', 'bookmarks_count')) {
                $table->integer('bookmarks_count')->default(0);
            }
            
            if (!Schema::hasColumn('articles', 'shares_count')) {
                $table->integer('shares_count')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $columns = ['tags', 'likes_count', 'bookmarks_count', 'shares_count'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('articles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};