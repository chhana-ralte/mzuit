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
    public function checking(){
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
        return ['course'=>$course,'sessn'=>$sessn,'semester'=>$semester];
    }
    public function enrollSubject(){
        $check = $this->checking();
        $enrolls = Enroll::where('sessn_id',$check['sessn']->id)
        ->where('semester',$check['semester'])
        ->where('course_id',$check['course']->id)
        ->get();
        $enrollSubjectExists = Enroll_Subject::whereIn('enroll_id',$enrolls->pluck('id'))->exists();
        if($enrollSubjectExists){
            $data = [
                'course' => $check['course'],
                'semester' => $check['semester'],
                'sessn' =>$check['sessn'],
                'enrollSubjectExists'=>$enrollSubjectExists
            ];
            return view('mass.enrollsubject',$data);    
        }

        
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
            'course' => $check['course'],
            'semester' => $check['semester'],
            'sessn' =>$check['sessn']
        ];
        return view('mass.enrollsubject',$data);
    }
    public function enrollSubjectStore(){
        if(request()->exists){ // Clear the existing enroll_subjects
            $enrolls = Enroll::where('sessn_id',request()->sessn)
                ->where('semester',request()->semester)
                ->where('course_id',request()->course)
                ->get();
            Enroll_Subject::whereIn('enroll_id',$enrolls->pluck('id'))->delete();
            return redirect('/mass/enrollsubject?course=' . request()->course . '&sessn=' . request()->sessn . '&semester=' . request()->semester)
                ->with(['message' => ['type'=>'info', 'text'=>'Cleared subject enrolments']]);
        }
        else{
            $enrolls = Enroll::whereIn('id',request()->enrolls)->get();
            foreach($enrolls as $e){
                $e->subjects()->detach(request()->subjects);
                $e->subjects()->attach(request()->subjects);
            }
    
            return redirect('/course/' . request()->course . '?sessn=' . request()->sessn . '&semester=' . request()->semester)
                ->with(['message' => ['type'=>'info', 'text'=>'Mass assignment of subjects completed']]);
            }
    }
    public function promote(){
        $check = $this->checking();
        $enrolls = Enroll::where('sessn_id',$check['sessn']->id)
            ->where('semester',$check['semester'])
            ->where('course_id',$check['course']->id)
            ->get();
        $data = [
            'enrolls' => $enrolls,
            'course' => $check['course'],
            'semester' => $check['semester'],
            'sessn' =>$check['sessn']
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
