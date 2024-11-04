<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            // เปลี่ยนแปลงโครงสร้างตาราง
            $table->string('registrant_name')->nullable()->change(); // เปลี่ยนให้ฟิลด์ `registrant_name` สามารถเป็น null ได้
            $table->json('team_members')->nullable()->change(); // เพิ่มฟิลด์ `team_members` เก็บข้อมูลแบบ JSON และสามารถเป็น null ได้
            $table->string('supervisor_phone')->nullable(false)->change(); // กำหนดให้ฟิลด์ `supervisor_phone` ไม่สามารถเป็น null ได้
            $table->string('supervisor_email')->nullable(false)->change(); // กำหนดให้ฟิลด์ `supervisor_email` ไม่สามารถเป็น null ได้
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            // ย้อนกลับการเปลี่ยนแปลง
            $table->string('registrant_name')->nullable(false)->change(); // ย้อนกลับให้ `registrant_name` ไม่สามารถเป็น null ได้
            $table->dropColumn('team_members'); // ลบฟิลด์ `team_members`
            $table->string('supervisor_phone')->nullable()->change(); // ย้อนกลับให้ `supervisor_phone` เป็น null ได้
            $table->string('supervisor_email')->nullable()->change();; // ย้อนกลับให้ `supervisor_email` เป็น null ได้
        });
    }
}
