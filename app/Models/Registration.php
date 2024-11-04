<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrant_name',
        'supervisor_name',
        'supervisor_email',
        'supervisor_phone',
        'project_name',
        'activity_id',
        'type',
        'level',
        'address',
        'school_name',
        'user_id',
        'title',
        'registrant_name',
        'team_members', // ควรเพิ่ม team_members ถ้าต้องการเก็บข้อมูลทีมในรูปแบบ JSON
    ];

    // ความสัมพันธ์กับ Activity
   
public function activity()
{
    return $this->belongsTo(Activity::class);
}


    // ความสัมพันธ์กับ TeamMember
    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
    
}
