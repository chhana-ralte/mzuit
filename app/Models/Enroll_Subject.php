<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll_Subject extends Model
{
    //use HasFactory;
    protected $guarded = [];
    protected $table = 'enroll_subject';
    
    public function enroll(){
        return $this->belongsTo(Enroll::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
