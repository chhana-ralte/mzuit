<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
    
    public function subjects(){
        return $this->belongsToMany(Teacher::class)->withPivot('sessn_id');
    }
}
