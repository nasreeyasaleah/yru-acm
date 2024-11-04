<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    // database/migrations/xxxx_xx_xx_create_registrations_table.php
public function up()
{
    Schema::create('registrations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('activity_id');
        $table->unsignedBigInteger('user_id');
        $table->string('registration_type'); // 'individual' หรือ 'team'
        $table->string('registrant_name')->nullable(); // ชื่อผู้ลงทะเบียน (ใช้สำหรับแบบรายบุคคล)
        $table->json('team_members')->nullable(); // เก็บข้อมูลสมาชิกทีมในรูปแบบ JSON
        $table->string('school_name');
        $table->string('supervisor_name');
        $table->string('supervisor_phone');
        $table->string('supervisor_email');
        $table->timestamps();
    
        $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    
    
}


    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
