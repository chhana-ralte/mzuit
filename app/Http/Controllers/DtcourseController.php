<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dtcourse;
use App\Models\Department;


class DtcourseController extends Controller
{
    public function index(){
        $dtcourses = Dtcourse::orderBy('department_id')->get();
        $data = [
            'dtcourses' => $dtcourses
        ];
        return view('diktei.dtcourse.index',$data);
    }

    public function create(){
        if(Auth::user()){
            return view('diktei.dtcourse.create',['departments'=>Department::all()]);
        }
        else{
            return redirect('/');
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'code' => 'required',
            'title' => 'required',
            'major' => 'required',
            'credit' => 'required',
            'intake' => 'required'
        ]);
        $department = Department::find($request->department);
        $dtcourse = Dtcourse::create([
            'code' => $request->code,
            'title' => $request->title,
            'major' => $request->major,
            'credit' => $request->credit,
            'intake' => $request->intake,
            'faculty' => $request->faculty,
            'contact' => $request->contact,
            'department_id' => $department->id,
            'dept' => $department->name
        ]);
        return redirect('/dtcourse')->with(['message'=>['type'=>'info','text'=>'Course created']]);
    }
    public function show(Dtcourse $dtcourse){
        return view('diktei.dtcourse.show',['dtcourse'=>$dtcourse]);
    }

    public function edit(Dtcourse $dtcourse){
        if(Auth::user()){
            $departments = Department::all();
            $data = [
                'departments' => $departments,
                'dtcourse' => $dtcourse
            ];
            return view('diktei.dtcourse.edit',$data);
        }
        else{
            return redirect('/');
        }
    }

    public function update(Request $request, Dtcourse $dtcourse){
        $data = $request->validate([
            'code' => 'required',
            'title' => 'required',
            'major' => 'required',
            'credit' => 'required',
            'intake' => 'required'
        ]);
        $department = Department::find($request->department);
        $dtcourse -> update([
            'code' => $request->code,
            'title' => $request->title,
            'major' => $request->major,
            'credit' => $request->credit,
            'intake' => $request->intake,
            'faculty' => $request->faculty,
            'contact' => $request->contact,
            'department_id' => $department->id,
            'dept' => $department->name
        ]);
        return redirect('/dtcourse/' . $dtcourse->id)->with(['message'=>['type'=>'info','text'=>'Course updated']]);
    }

    public function destroy(Dtcourse $dtcourse){
        $dtcourse->delete();
        return redirect('/dtcourse')->with(['message' => ['type' => 'info', 'text' => 'Course Deleted']]);
    }
}
