<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentSessn extends Model
{
    use HasFactory;

    public $table = "current_sessn";
    protected $guarded = [];
}
