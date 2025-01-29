<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diktei extends Model
{
    use HasFactory;

    public $guarded = [];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function options(){
        return $this->hasMany(Option::class);
    }

    public function dtoptions(){
        return $this->hasMany(Dtoption::class);
    }

    public function dtallot(){
        return $this->hasMany(Dtallot::class);
    }

    public function allotted(){
        if(Allot::where('diktei_id',$this->id)->exists()){
            return Allot::where('diktei_id',$this->id)->first();
        }
        else{
            return false;
        }
    }
}
