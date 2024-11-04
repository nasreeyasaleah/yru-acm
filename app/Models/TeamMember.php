<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrant_name',
        'supervisor_name',
        'supervisor_phone',
        'activity_id',
        'type',
        'school_name',
        'user_id',
        'title',
        'registrant_name',
        'activity_id',
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

    // ความสัมพันธ์กับ Certificate
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
