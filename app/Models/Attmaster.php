<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attmaster extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function sessn(){
        return $this->belongsTo(Sessn::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

}
