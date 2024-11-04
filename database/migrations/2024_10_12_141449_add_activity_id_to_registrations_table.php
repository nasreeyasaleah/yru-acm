<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['activity_id']);
            $table->dropColumn('activity_id');
        });
    }
    
};
