<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjectcontent extends Model
{
    //use HasFactory;
    protected $guarded = [];
    public function subject(){
        return $this->belongsTo(Subject);
    }
}
