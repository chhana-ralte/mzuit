<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function create(){
        return view('sample.create');
    }
    public function show(){
        return view('sample.show');
    }
}
