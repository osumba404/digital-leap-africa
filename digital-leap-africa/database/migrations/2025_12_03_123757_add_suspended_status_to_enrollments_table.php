<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // For MySQL, we need to alter the enum column to include 'suspended'
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('pending', 'active', 'completed', 'dropped', 'rejected', 'suspended') DEFAULT 'pending'");
    }

    public function down()
    {
        // Remove 'suspended' from the enum
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('pending', 'active', 'completed', 'dropped', 'rejected') DEFAULT 'pending'");
    }
};