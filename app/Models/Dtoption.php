<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtoption extends Model
{
    public $table = 'dtoptions';
    protected $guarded = [];

    public function dtcourse(){
        return $this->belongsTo(Dtcourse::class);
    }
    public function diktei(){
        return $this->belongsTo(Diktei::class);
    }
}
