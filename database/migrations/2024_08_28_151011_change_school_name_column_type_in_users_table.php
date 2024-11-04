<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSchoolNameColumnTypeInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('school_name', 255)->change(); // เปลี่ยนประเภทข้อมูลเป็น VARCHAR(255)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('school_name')->change(); // ย้อนกลับประเภทข้อมูลเป็น INTEGER
        });
    }
}
