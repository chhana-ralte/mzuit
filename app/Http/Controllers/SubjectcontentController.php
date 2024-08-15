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
        if(request()->version){
            $version = request()->version;
        }
        else{
            $version = "Default";
        }
        Subjectcontent::create([
            'subject_id' => $subject->id,
            'version' => $version,
            'content' => request()->content
        ]);
        return redirect('/subject/' . $subject->id)->with(['message' => ['type'=>'info', 'text' => 'Subject Updated']]);
    }

    public function edit(Subjectcontent $subjectcontent){
        //return $subjectcontent;
        //dd($content->id);
        return view('common.subject.contentedit',['subjectcontent'=>$subjectcontent]);
    }

    public function update(Subjectcontent $subjectcontent){
        if(request()->version){
            $version = request()->version;
        }
        else{
            $version = "Default";
        }
        $subjectcontent->update([
            'version' => $version,
            'content' => request()->content
        ]);
        return redirect('/subject/' . $subjectcontent->subject->id)->with(['message' => ['type'=>'info', 'text' => 'Content Updated']]);
    }
    public function destroy(Subjectcontent $subjectcontent){
        $subject_id = $subjectcontent->subject->id;
        $subjectcontent->delete();
        return ['message'=>"Deleted", 'subject_id'=>$subject_id];
    }
}
