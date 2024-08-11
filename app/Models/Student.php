<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function sessn(){
        return $this->belongsTo(Sessn::class);
    }

    public function batch(){
        return $this->sessn()->start_yr;
    }
    
    public function enrolls(){
        return $this->hasMany(Enroll::class);
    }

}
