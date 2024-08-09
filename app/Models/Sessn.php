<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessn extends Model
{
    //use HasFactory;
    Protected $guarded = [];

    public static function current_sessn(){
        $cs = CurrentSessn::first();
        return Sessn::find($cs->current_sessn);
    }

    public function name(){
        $odd_even = $this->odd_even==1?'Odd':'Even';
        return $this->start_yr . '-' . substr($this->end_yr,-2) . '(' . $odd_even . ')';
    }

    public function cur_ssn(){
        if(Sessn::current_sessn()->id == $this->id){
            return true;
        }
        else{
            return false;
        }
    }
}
