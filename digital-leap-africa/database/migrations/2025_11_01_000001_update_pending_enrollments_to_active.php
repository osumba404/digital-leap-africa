<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Update all pending enrollments to active
        DB::table('enrollments')
            ->where('status', 'pending')
            ->update(['status' => 'active']);
    }

    public function down()
    {
        // Revert active enrollments back to pending
        DB::table('enrollments')
            ->where('status', 'active')
            ->update(['status' => 'pending']);
    }
};