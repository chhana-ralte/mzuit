<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtcourse extends Model
{
    public $table = 'dtcourses';
    protected $guarded = [];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function dtoptions(){
        return $this->hasMany(Dtoption::class);
    }

    public function filled(){
        return Dtallot::where('dtcourse_id',$this->id)->count();
    }

    public function vacant(){
        return $this->intake - Dtallot::where('dtcourse_id',$this->id)->count();
    }
    
    public function dtallots(){
        return $this->hasMany(Dtallot::class);
    }

    public function type(){
        return $this->major?"IMJ":"IMN";
    }
}
