<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
    public function attmaster(){
        return $this->belongsTo(Attmaster::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
