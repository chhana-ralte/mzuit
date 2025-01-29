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

    public function imjoptions(){
        return Dtoption::where('diktei_id',$this->id)->where('major',1)->get();
    }

    public function imnoptions(){
        return Dtoption::where('diktei_id',$this->id)->where('major',0)->get();
    }

    public function dtallot(){
        return $this->hasMany(Dtallot::class);
    }

    public function allotted(){
        if(Dtallot::where('diktei_id',$this->id)->exists()){
            return Dtallot::where('diktei_id',$this->id)->first();
        }
        else{
            return false;
        }
    }
    public function mjallotted(){
        if(Dtallot::where('diktei_id',$this->id)->where('major',1)->exists()){
            return Dtallot::where('diktei_id',$this->id)->where('major',1)->first();
        }
        else{
            return false;
        }
    }
    public function mnallotted(){
        if(Dtallot::where('diktei_id',$this->id)->where('major',0)->exists()){
            return Dtallot::where('diktei_id',$this->id)->where('major',0)->first();
        }
        else{
            return false;
        }
    }
}
