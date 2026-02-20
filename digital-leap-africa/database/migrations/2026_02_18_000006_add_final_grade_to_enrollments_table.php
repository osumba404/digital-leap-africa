<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Final grade is calculated from: lesson tests + final exam (pre_course does not count).
     */
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->decimal('final_grade_percentage', 5, 2)->nullable()->after('completed_at');
            $table->decimal('final_grade_points_earned', 10, 2)->nullable()->after('final_grade_percentage');
            $table->decimal('final_grade_points_possible', 10, 2)->nullable()->after('final_grade_points_earned');
            $table->timestamp('final_grade_calculated_at')->nullable()->after('final_grade_points_possible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'final_grade_percentage',
                'final_grade_points_earned',
                'final_grade_points_possible',
                'final_grade_calculated_at',
            ]);
        });
    }
};
