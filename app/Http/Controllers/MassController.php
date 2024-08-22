<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sessn;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Syllabus;
use App\Models\Subject;
use App\Models\Enroll_Subject;

class MassController extends Controller
{
    public function enrollSubject(){
        if(isset($_GET['course'])){
            $course = Course::findOrFail($_GET['course']);
        }
        else{
            abort(403);
        }
        if(isset($_GET['sessn'])){
            $sessn = Sessn::findOrFail($_GET['sessn']);
        }
        else{
            abort(403);
        }
        if(isset($_GET['semester'])){
            $semester = $_GET['semester'];
        }
        else{
            abort(403);
        }

        $enrollSubjectExists = Enroll_Subject::whereIn('enroll_id',$enrolls->pluck('id'))->exists();

        return view('mass.enrollsubject',['enrollSubjectExists'=>$enrollSubjectExists]);

        $enrolls = Enroll::where('sessn_id',$sessn->id)
            ->where('semester',$semester)
            ->where('course_id',$course->id)
            ->get();
        $batch = $sessn->start_yr - ($semester - $sessn->odd_even)/2;

        $syllabus = Syllabus::where('course_id',$course->id)
            ->where('from_batch','<=',$batch)
            ->where('to_batch','>=',$batch)
            ->first();

        $subjects = Subject::where('syllabus_id',$syllabus->id)
            ->where('semester',$semester)
            ->get();
        $data = [
            'enrollSubjectExists' => false,
            'subjects' => $subjects,
            'enrolls' => $enrolls,
            'course' => $course,
            'semester' => $semester,
            'sessn' =>$sessn
        ];
        return view('mass.enrollsubject',$data);
    }
    public function enrollSubjectStore(){
        
        $enrolls = Enroll::whereIn('id',request()->enrolls)->get();
        foreach($enrolls as $e){
            $e->subjects()->detach(request()->subjects);
            $e->subjects()->attach(request()->subjects);
        }

        return redirect('/course/' . request()->course . '?sessn=' . request()->sessn . '&semester=' . request()->semester)
            ->with(['message' => ['type'=>'info', 'text'=>'Mass assignment of subjects completed']]);
    }
    public function promote(){
        if(isset($_GET['course'])){
            $course = Course::findOrFail($_GET['course']);
        }
        else{
            abort(403);
        }
        if(isset($_GET['sessn'])){
            $sessn = Sessn::findOrFail($_GET['sessn']);
        }
        else{
            abort(403);
        }
        if(isset($_GET['semester'])){
            $semester = $_GET['semester'];
        }
        else{
            abort(403);
        }
        $enrolls = Enroll::where('sessn_id',$sessn->id)
            ->where('semester',$semester)
            ->where('course_id',$course->id)
            ->get();
        $data = [
            
            'enrolls' => $enrolls,
            'course' => $course,
            'semester' => $semester,
            'sessn' =>$sessn
        ];
        return view('mass.promote',$data);

    }
    public function promoteStore(){
        //dd(Sessn::findOrFail(request()->sessn)->nextSessn()->id);
        $enrolls = Enroll::whereIn('id',request()->enrolls)->get();
        foreach($enrolls as $e){
            Enroll::updateOrCreate([
                'student_id' => $e->student->id,
                'semester' => request()->semester + 1,
                'sessn_id' => Sessn::findOrFail(request()->sessn)->nextSessn()->id,
                'course_id' => request()->course
            ],[
                'student_id' => $e->student->id,
                'semester' => request()->semester + 1,
                'sessn_id' => Sessn::findOrFail(request()->sessn)->nextSessn()->id,
                'course_id' => request()->course
            ]);
        }
        return redirect('/course/' . request()->course . '?sessn=' . request()->sessn . '&semester=' . request()->semester)
            ->with(['message' => ['type'=>'info', 'text'=>'Mass promotion is done']]);
    }
}
