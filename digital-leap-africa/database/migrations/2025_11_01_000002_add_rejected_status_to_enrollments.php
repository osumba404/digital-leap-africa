<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('pending', 'active', 'completed', 'dropped', 'rejected') DEFAULT 'pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('pending', 'active', 'completed', 'dropped') DEFAULT 'pending'");
    }
};