<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Course $course, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($syllabus_id)
    {
        $syllabus = Syllabus::findOrFail($syllabus_id);
        $subjects = Subject::where('syllabus_id',$syllabus->id)->orderBy('semester')->get();
        return view('common.syllabus.show',['syllabus'=>$syllabus, 'subjects'=>$subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Syllabus $syllabus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Syllabus $syllabus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Syllabus $syllabus)
    {
        //
    }
}
