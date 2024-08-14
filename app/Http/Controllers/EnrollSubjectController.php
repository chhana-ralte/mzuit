<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Sessn;
use App\Models\Enroll;
use App\Models\Enroll_Subject;
use App\Models\Subject;
use App\Models\Syllabus;



class EnrollSubjectController extends Controller
{
    public function index() //required semester, course and session to be passed in GET
    {
        $sessn = Sessn::find($_GET['sessn']);
        $course = Course::find($_GET['course']);
        $semester = $_GET['semester'];
        $semesters = [];
        for($i=$sessn->odd_even;$i<= $course->max_sem; $i += 2)
        {
            array_push($semesters,$i);
        }
        $enrolls = Enroll::where('course_id',$_GET['course'])
            ->where('sessn_id',$_GET['sessn'])
            ->where('semester',$_GET['semester'])
            ->get();

        $enroll_subjects = Enroll_Subject::whereIn('enroll_id',$enrolls->pluck('id'))->get();
        $subjects = Subject::whereIn('id',$enroll_subjects->pluck('subject_id'))->get();
        $arr = [];

        foreach($enroll_subjects as $es){
            $arr[$es->enroll_id][$es->subject_id]=$es->id;
        }
        $data = [
            'sessns' => Sessn::orderBy('start_yr')->get(),
            'course' => $course,
            'semester' => $semester,
            'semesters' => $semesters,
            'sessn' => $sessn,
            'enrolls' => $enrolls,
            'subjects' => $subjects,
            'enroll_subjects' => $arr
        ];

        return view('common.enroll_subject.index',$data);
        return $arr;
    }

    public function create()
    {
        //
    }

    public function store(Enroll $enroll)
    {
        Enroll_Subject::updateOrCreate([
            'enroll_id' => $enroll->id,
            'subject_id' => request()->subject,
        ],[
            'enroll_id' => $enroll->id,
            'subject_id' => request()->subject,
        ]);
        return redirect('/enroll_subject/' . $enroll->id)
            ->with(['message'=>['type'=>'info', 'text'=>'Subject added']]);
    }

    public function show(Enroll $enroll)
    {
        //dd($enroll->subjects);
        $batch = $enroll->sessn->start_yr - ($enroll->semester - $enroll->sessn->odd_even)/2;
        //dd($batch);
        $syllabus = Syllabus::where('course_id',$enroll->course->id)
            ->where('from_batch','<=',$batch)
            ->where('to_batch','>=',$batch)
            ->first();
        $nosubjects = Subject::where('syllabus_id',$syllabus->id)
            ->where('semester',$enroll->semester)
            ->whereNotIn('id',$enroll->subjects->pluck('id'))
            ->get();
        $data = [
            'enroll' => $enroll,
            'nosubjects' => $nosubjects
        ];
        //dd($nosubject);
        return view('common.enroll_subject.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enroll_Subject $enroll_Subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enroll_Subject $enroll_Subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enroll $enroll)
    {
        Enroll_Subject::where('enroll_id',$enroll->id)
            ->where('subject_id',request()->subject)
            ->delete();
        return redirect('/enroll_subject/' . $enroll->id)
            ->with(['message'=>['type'=>'info', 'text'=>'Subject removed']]);
    }
}
