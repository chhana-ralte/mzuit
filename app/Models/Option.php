<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    public $guarded = [];

    public function diktei(){
        return $this->belongsTo(Diktei::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
