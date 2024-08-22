<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Department $department)
    {
        $teachers  = Teacher::where('department_id',$department->id)->where('deleted',0)->get();
        $hiddenteachers  = Teacher::where('department_id',$department->id)->where('deleted',1)->get();
        $data = [
            'department' => $department,
            'teachers' => $teachers,
            'hiddenteachers' => $hiddenteachers,
        ];
        return view('common.teacher.index',$data);
    }

    public function create(Department $department)
    {
        $data = [
            'department' => $department
        ];
        return view('common.teacher.create',$data);
    }

    public function store(Department $department, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'father' => 'nullable',
            'dob' => ['nullable', 'date'],
            'email' =>['nullable', 'email'],
            'phone' => ['nullable', 'regex:/[0-9]{10}/'],
            'address' => ['nullable', 'max:255'],
            'category' => ['nullable'],
            'idcard' => ['nullable'],
        ]);

            //dd($validated);
        $person = \App\Models\Person::create([
            'name' => $request->name,
            'father' => $request->father,
            'dob' => $request->dob,
            'category' => $request->category
        ]);

        if($request->email){
            \App\Models\Email::updateOrCreate([
                'person_id' => $person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $person->id,
                'type' => 'Personal',
                'email' => $request->email
            ]);
        }
        if($request->phone){
            \App\Models\Phone::updateOrCreate([
                'person_id' => $person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $person->id,
                'type' => 'Personal',
                'phone' => $request->phone
            ]);
        }
        if($request->address){
            \App\Models\Address::updateOrCreate([
                'person_id' => $person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $person->id,
                'type' => 'Personal',
                'address' => $request->address
            ]);
        }
         
        $teacher = \App\Models\Teacher::create([
            'person_id' => $person->id,
            'idcard' => $request->idcard,
            'designation' => $request->designation,
            'department_id' => $request->department,
        ]);

        return redirect('/department/' . $department->id . '/teacher')
            ->with(['message'=>['type'=>'info', 'text'=>'Teacher Added']]);
    }

    public function show(Teacher $teacher)
    {
        return view('common.teacher.show',['teacher'=>$teacher]);
    }

    public function edit(Teacher $teacher)
    {
        $person = $teacher->person;
        if(\App\Models\Email::where('person_id',$person->id)->exists()){
            $email = \App\Models\Email::where('person_id',$person->id)->first()->email;
        }
        else{
            $email = "";
        }

        if(\App\Models\Phone::where('person_id',$person->id)->exists()){
            $email = \App\Models\Phone::where('person_id',$person->id)->first()->phone;
        }
        else{
            $phone = "";
        }

        if(\App\Models\Address::where('person_id',$person->id)->exists()){
            $address = \App\Models\Address::where('person_id',$person->id)->first()->address;
        }
        else{
            $address = "";
        }
        $data = [
            'teacher' => $teacher,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
        return view('common.teacher.edit',$data);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required',
            'father' => 'nullable',
            'dob' => ['nullable', 'date'],
            'email' =>['nullable', 'email'],
            'phone' => ['nullable', 'regex:/[0-9]{10}/'],
            'address' => ['nullable', 'max:255'],
            'category' => ['nullable'],
            'idcard' => ['nullable'],
        ]);

            //dd($validated);
        $teacher->person->update([
            'name' => $request->name,
            'father' => $request->father,
            'dob' => $request->dob,
            'category' => $request->category
        ]);

        if($request->email){
            \App\Models\Email::updateOrCreate([
                'person_id' => $teacher->person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $teacher->person->id,
                'type' => 'Personal',
                'email' => $request->email
            ]);
        }
        if($request->phone){
            \App\Models\Phone::updateOrCreate([
                'person_id' => $teacher->person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $teacher->person->id,
                'type' => 'Personal',
                'phone' => $request->phone
            ]);
        }
        if($request->address){
            \App\Models\Address::updateOrCreate([
                'person_id' => $teacher->person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $teacher->person->id,
                'type' => 'Personal',
                'address' => $request->address
            ]);
        }
         
        $teacher->update([
            'idcard' => $request->idcard,
            'designation' => $request->designation,
            'department_id' => $request->department,
        ]);

        return redirect('/teacher/' . $teacher->id)
            ->with(['message'=>['type'=>'info', 'text'=>'Teacher Updated']]);
    }

    public function destroy(Teacher $teacher)
    {
        if(request()->type == 'hide'){
            $teacher->update(['deleted'=>1]);
            if(request()->ajax=='yes'){
                return "Teacher hidden";
            }
            return redirect('/department/' . $teacher->department->id)
                ->with(['message' => ['type'=>'info', 'text'=>'Teacher hidden']]);    
        }
        else{
            $teacher->update(['deleted'=>0]);
            if(request()->ajax=='yes'){
                return "Teacher shown";
            }
            return redirect('/department/' . $teacher->department->id)
                ->with(['message' => ['type'=>'info', 'text'=>'Teacher shown']]);    
        }
    }
}
