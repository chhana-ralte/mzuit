<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function sessn(){
        return $this->belongsTo(Sessn::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class)->withPivot('internal');
    }
}
