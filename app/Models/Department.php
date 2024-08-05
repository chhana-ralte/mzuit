<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function school(){
        return $this->belongsTo(School::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function slot(){
        if(Deptslot::where('department_id',$this->id)->exists()){
            return Deptslot::where('department_id',$this->id)->first()->slot;
        }
        else {
            return 0;
        }
    }

    public function allotted(){
        return Allot::where('department_id',$this->id)->count();
    }
}
