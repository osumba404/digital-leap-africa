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
    public function up()
    {
        Schema::table('badges', function (Blueprint $table) {
            // Drop user_id foreign key and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            
            // Add new columns
            $table->text('description')->nullable()->after('badge_name');
            $table->string('img_url')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badges', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['description', 'img_url']);
            
            // Add back user_id
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        });
    }
};
