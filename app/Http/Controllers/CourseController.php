<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Sessn;
use App\Models\Enroll;
use App\Models\Enroll_Subject;


use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Department $department)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Course $course)
    {
        $enrolls_ssn = Enroll::where('course_id',$course->id)
            ->groupBy('sessn_id')
            ->distinct('sessn_id')
            //->get();
            ->pluck('sessn_id');
        $sessns = Sessn::orderBy('start_yr')
            ->orderBy('odd_even')
            ->whereIn('id',$enrolls_ssn)
            ->get();

        if(isset($_GET['sessn'])){
            $sessn = Sessn::findOrFail($_GET['sessn']);
        }
        else{
            $sessn = Sessn::current_sessn();
        }
        if(isset($_GET['semester'])){
            $semester = $_GET['semester'];
        }
        else{
            $semester = $sessn->odd_even;
        }

        $semesters = [];
        for($i=$sessn->odd_even; $i<=$course->max_sem; $i+=2)
        {
            array_push($semesters,$i);
        }
        $enrolls = Enroll::join('students','students.id','=','enrolls.student_id')
            ->where('enrolls.sessn_id',$sessn->id)
            ->where('enrolls.course_id',$course->id)
            ->where('enrolls.semester',$semester)
            ->orderBy('students.rollno')
            ->get(['enrolls.*']);
        
        $data = [
            'sessns' => $sessns,
            'semester' => $semester,
            'semesters' => $semesters,
            'sessn' => $sessn,
            'enrolls' => $enrolls,
            'course' => $course,
            'nextSemesterExists' => Enroll::whereIn('student_id',$enrolls->pluck('student_id'))->where('semester',$semester+1)->where('sessn_id',$sessn->nextSessn()?$sessn->nextSessn()->id:0)->exists()
        ];

        return view('common.course.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
