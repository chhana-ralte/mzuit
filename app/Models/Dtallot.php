<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtallot extends Model
{
    protected $guarded = [];

    public function diktei(){
        return $this->belongsTo(Diktei::class);
    }

    public function dtcourse(){
        return $this->belongsTo(Dtcourse::class);
    }

}
