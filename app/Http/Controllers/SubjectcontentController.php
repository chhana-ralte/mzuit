<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Subjectcontent;

class SubjectcontentController extends Controller
{
    public function create(Subject $subject){
        return view('common.subject.contentcreate',['subject' => $subject]);
    }

    public function store(Subject $subject){
        Subjectcontent::create([
            'subject_id' => $subject->id,
            'version' => 'Default',
            'content' => request()->content
        ]);
        return redirect('/subject/' . $subject->id)->with(['message' => ['type'=>'info', 'text' => 'Subject Updated']]);
        dd(request()->all());
    }
}
