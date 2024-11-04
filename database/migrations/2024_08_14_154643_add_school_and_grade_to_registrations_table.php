<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('school_name')->nullable();
            $table->string('grade')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['school_name', 'grade']);
        });
    }
    
};
