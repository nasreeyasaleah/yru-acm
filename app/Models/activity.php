<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'level',
        'year',
        'Certificate_type',
        'date',
        'start_time',
        'end_time',
        'teacher_name',
        'team_limit',
        'registration_limit',
        'registration_count',
        'registration_end_date',
        'school_limit',
      
    ];


    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }


}
