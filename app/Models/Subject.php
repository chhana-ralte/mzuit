<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function enrolls(){
        return $this->belongsToMany(Enroll::class);
    }

    public function syllabus(){
        return $this->belongsTo(Syllabus::class);
    }

    public function contents(){
        return $this->hasmany(Subjectcontent::class);
    }

    public function subjectcontents(){
        return $this->hasmany(Subjectcontent::class);
    }

}
