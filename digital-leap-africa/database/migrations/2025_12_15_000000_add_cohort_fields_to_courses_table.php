<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->enum('course_type', ['self_paced', 'cohort_based'])->default('self_paced')->after('price');
            $table->integer('duration_weeks')->nullable()->after('course_type');
            $table->date('start_date')->nullable()->after('duration_weeks');
            $table->date('end_date')->nullable()->after('start_date');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['course_type', 'duration_weeks', 'start_date', 'end_date']);
        });
    }
};