<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessn = \App\Models\Sessn::findOrFail(request()->query('sessn'));
        $course = \App\Models\Course::findOrFail(request()->query('course'));
        $semester = request()->query('semester');

        $data = [
            'sessn' => $sessn,
            'course' => $course,
            'semester' => $semester
        ];
        
        return view('common.enroll.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'father' => 'nullable',
            'dob' => ['nullable', 'date'],
            'email' =>['nullable', 'email'],
            'phone' => ['nullable', 'regex:/[0-9]{10}/'],
            'address' => ['nullable', 'max:255'],
            'category' => ['nullable'],
            'rollno' => 'nullable',
            'registration' => 'nullable',
            'batch' => 'numeric'
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
                'person_id' => $enroll->student->person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $enroll->student->person->id,
                'type' => 'Personal',
                'email' => $request->email
            ]);
        }
        if($request->phone){
            \App\Models\Phone::updateOrCreate([
                'person_id' => $enroll->student->person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $enroll->student->person->id,
                'type' => 'Personal',
                'phone' => $request->phone
            ]);
        }
        if($request->address){
            \App\Models\Address::updateOrCreate([
                'person_id' => $enroll->student->person->id,
                'type' => 'Personal',
            ],[
                'person_id' => $enroll->student->person->id,
                'type' => 'Personal',
                'address' => $request->address
            ]);
        }
         
        $student = \App\Models\Student::create([
            'person_id' => $person->id,
            'rollno' => $request->rollno,
            'type' => $request->type,
            'course_id' => $request->course,
            'registration' => $request->registration,
            'sessn_id' => $request->sessn,
            'dropout' => 0,
            'completed' => 0,
        ]);

        $enroll = \App\Models\Enroll::create([
            'student_id' => $student->id,
            'course_id' => $request->course,
            'sessn_id' => $request->sessn,
            'semester' => $request->semester
        ]);
        return redirect('/course/' . $request->course .'?sessn=' . $request->sessn . '&semester=' . $request->semester)
            ->with(['message' => ['type'=>'info', 'text'=>'Student added successfully']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enroll $enroll)
    {
        return view('common.enroll.show',['enroll'=>$enroll]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enroll $enroll)
    {
        $student = $enroll->student;
        $person = $student->person;
        $email = \App\Models\Email::where('person_id',$person->id)->first();
        $phone = \App\Models\Phone::where('person_id',$person->id)->first();
        $address = \App\Models\Address::where('person_id',$person->id)->first();

        $data = [
            'student' => $student,
            'person' => $person,
            'enroll' => $enroll,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
        return view('common.enroll.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enroll $enroll)
    {
        if($request->updateType == "personal"){
            $validated = $request->validate([
                'name' => 'required',
                'father' => 'nullable',
                'dob' => ['nullable', 'date'],
                'email' =>['nullable', 'email'],
                'phone' => ['nullable', 'regex:/[0-9]{10}/'],
                'address' => ['nullable', 'max:255'],
                'category' => ['nullable']
            ]);
            //dd($validated);
            $enroll->student->person->update([
                'name' => $request->name,
                'father' => $request->father,
                'dob' => $request->dob,
                'category' => $request->category
            ]);

            if($request->email){
                \App\Models\Email::updateOrCreate([
                    'person_id' => $enroll->student->person->id,
                    'type' => 'Personal',
                ],[
                    'person_id' => $enroll->student->person->id,
                    'type' => 'Personal',
                    'email' => $request->email
                ]);
            }
            if($request->phone){
                \App\Models\Phone::updateOrCreate([
                    'person_id' => $enroll->student->person->id,
                    'type' => 'Personal',
                ],[
                    'person_id' => $enroll->student->person->id,
                    'type' => 'Personal',
                    'phone' => $request->phone
                ]);
            }
            if($request->address){
                \App\Models\Address::updateOrCreate([
                    'person_id' => $enroll->student->person->id,
                    'type' => 'Personal',
                ],[
                    'person_id' => $enroll->student->person->id,
                    'type' => 'Personal',
                    'address' => $request->address
                ]);
            }
        }
        else if($request->updateType == "student"){
            $sessn = \App\Models\Sessn::where('start_yr',$request->batch)->first();
            $enroll->student->update([
                'rollno' => $request->rollno,
                'type' => $request->type,
                'registration' => $request->registration,
                'sessn_id' => $sessn?$sessn->id:0,
                'dropout' => $request->status=="Dropped out",
                'completed' => $request->status=="Completed",
            ]);
        }
        return redirect('/enroll/' . $enroll->id)->with(['message' => ['type'=>'info', 'text'=>"Updated..."]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enroll $enroll)
    {
        //
    }
}
