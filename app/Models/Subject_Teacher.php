<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject_Teacher extends Model
{
    //use HasFactory;
    protected $table = 'subject_teacher';
    protected $guarded = [];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
