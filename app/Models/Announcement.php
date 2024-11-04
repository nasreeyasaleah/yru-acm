<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'announcement_date',
        'file_path', // ตรวจสอบให้แน่ใจว่า column นี้ถูกต้อง
    ];

}
