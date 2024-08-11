<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Department $department)
    {
        $teachers  = $department->teachers;
        $data = [
            'department' => $department,
            'teachers' => $teachers
        ];
        return view('common.teacher.index',$data);
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

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //return request()->ajaxed;
        $teacher->delete();
        if(request()->ajax=='yes'){
            return "Teacher deleted";
        }
        return redirect('/department/' . $teacher->department->id)
            ->with(['message' => ['type'=>'info', 'text'=>'Teacher deleted']]);
    }
}
