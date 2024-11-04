<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    public function up()
{
    Schema::create('team_members', function (Blueprint $table) {
        $table->id();
        $table->foreignId('registration_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->timestamps();
    });
    
    Schema::create('team_members', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('registration_id');
        $table->string('name'); // ชื่อสมาชิกทีม
        $table->timestamps();
    
        $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
    });
    
}

    public function down()
    {
        Schema::dropIfExists('team_members');
    }
}
