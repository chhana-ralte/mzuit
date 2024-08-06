<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectcontentController extends Controller
{
    public function create(Subject $subject){
        return view('common.subject.contentcreate',['subject' => $subject]);
    }

    public function store(Subject $subject){
        return "Hello";
    }
}
