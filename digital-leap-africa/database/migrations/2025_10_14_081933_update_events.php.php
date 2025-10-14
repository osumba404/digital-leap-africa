<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Basic columns
            $table->string('topic', 120)->nullable()->after('location');
            $table->dateTime('ends_at')->nullable()->after('date');
            $table->string('slug')->nullable()->after('title');

            // Unique index for slug
            $table->unique('slug');
        });

        // Backfill slug for existing rows
        DB::table('events')->orderBy('id')->chunkById(200, function ($rows) {
            foreach ($rows as $row) {
                if (empty($row->slug) && !empty($row->title)) {
                    $base = Str::slug($row->title);
                    $slug = $base;
                    $i = 1;

                    while (DB::table('events')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                        $slug = $base.'-'.$i++;
                    }

                    DB::table('events')->where('id', $row->id)->update(['slug' => $slug]);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['topic', 'ends_at', 'slug']);
        });
    }
};