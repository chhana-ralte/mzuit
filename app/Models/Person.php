<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function emails(){
        return $this->hasMany(Email::class);
    }
    public function phones(){
        return $this->hasMany(Phone::class);
    }
    public function addresses(){
        return $this->hasMany(Address::class);
    }
}
