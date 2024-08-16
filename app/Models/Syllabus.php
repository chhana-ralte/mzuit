<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'syllabi';
    
    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
