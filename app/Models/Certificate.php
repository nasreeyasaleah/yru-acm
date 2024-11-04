<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';
    protected $fillable = [
        'title', 'name1', 'position1', 'name2', 'position2', 'signature1', 'signature2'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}


