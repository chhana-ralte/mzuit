<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sessn;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Syllabus;
use App\Models\Subject;

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

        return view('mass.enrollsubject',['subjects'=>$subjects, 'enrolls'=>$enrolls]);
    }
    public function enrollSubjectStore(){
        
        $enrolls = Enroll::whereIn('id',request()->enrolls)->get();
        foreach($enrolls as $e){
            $e->subjects()->detach(request()->subjects);
            $e->subjects()->attach(request()->subjects);
        }

        //return redirect('/mass/enrollsubject?')
    }
}
