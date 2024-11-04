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
        Schema::table('activities', function (Blueprint $table) {
            $table->integer('registration_limit')->nullable()->after('date'); // เพิ่มคอลัมน์ใหม่
            DB::statement('ALTER TABLE activities MODIFY registration_count INTEGER DEFAULT 0'); // เปลี่ยนค่า default ของ registration_count
        });
    }
    
    public function down()
{
    Schema::table('activities', function (Blueprint $table) {
        $table->dropColumn(['registration_limit', 'registration_count']);
    });
}
    

   
   
    
};
