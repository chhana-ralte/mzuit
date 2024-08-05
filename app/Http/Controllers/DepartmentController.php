<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\School;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(School $school)
    {
        return view('common.department.index',['schools' => School::all()]);
    }

    public function create(School $school)
    {
        return view('common.department.create',['school' => $school]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => ['required','numeric'],
            'code' => ['required','min:3'],
            'name' => 'required'
        ]);
        $department = Department::create($validated);
        //return redirect('/school');
        $message = ['type'=>'info', 'text'=>'Department Created Successfully'];
        return redirect()->route('school.department.create',$department->school_id)->with('message', $message);
    }

    public function show(Department $department)
    {
        return view('common.department.show',['department' => $department]);
    }

    public function edit(Department $department)
    {
        return view('common.department.edit',['department' => $department]);
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'code' => ['required','min:3'],
            'name' => 'required'
        ]);
        $department->update($validated);
        $message = ['type' => 'info', 'text' => 'Department is updated'];
        return redirect('/department/' . $department->id)->with('message', $message);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        //Session::flash('message',['type' => 'info', 'text' => 'School is deleted']);
        $message = ['type' => 'info', 'text' => 'Department is deleted'];
        return redirect('/school/' . $department->school_id)->with('message', $message);
    }
}
