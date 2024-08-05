<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function enrolls(){
        $this->belongsToMany(Enroll::class);
    }

    public function syllabus(){
        $this->belongsTo(Syllabus::class);
    }
}
