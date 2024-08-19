<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attmaster;
use App\Models\Sessn;
use App\Models\Subject;
use App\Models\Subject_Teacher;
use App\Models\Enroll_Subject;

class AttmasterController extends Controller
{
    public function index(User $user)
    {
        if(isset($_GET['sessn'])){
            $sessn = Sessn::findOrFail($_GET['sessn']);
        }
        else{
            $sessn = Sessn::current_sessn();
        }
        $attmasters = Attmaster::where('user_id',$user->id)
            ->where('sessn_id',$sessn->id)
            ->orderBy('dt')
            ->get();
        $data = [
            'attmasters' => $attmasters
        ];
        return view('attmaster.index',$data);
    }

    public function create(User $user)
    {
        if(isset($_GET['sessn'])){
            $sessn = Sessn::findOrFail($_GET['sessn']);
        }
        else{
            $sessn = Sessn::current_sessn();
        }
        $subject_teachers = Subject_Teacher::where('teacher_id',$user->teacher_id)
            ->where('sessn_id',$sessn->id)
            ->get();
        $subjects = Subject::whereIn('id',$subject_teachers->pluck('subject_id'))->get();
        $data = [
            'sessn' => $sessn,
            'user' => $user,
            'subjects' => $subjects
        ];
        return view('attmaster.create',$data);
    }

    public function store(User $user, Request $request)
    {
        $validated = $request->validate([
            'dt' => 'date',
            'sessn_id' => 'required',
            'user_id' => 'required',
            'subject_id' => 'required',
            'slots' => 'required'
        ]);
        //dd($validated);
        Attmaster::create($validated);
        return redirect("/user/" . $user->id . "/attmaster")
            ->with(['message'=>['type'=>'info', 'text'=>'Attendance master created']]);
    }

    public function show(Attmaster $attmaster)
    {
        if(isset($_GET['sessn'])){
            $sessn = Sessn::findOrFail($_GET['sessn']);
        }
        else{
            $sessn = Sessn::current_sessn();
        }
        $enroll_ids = Enroll_Subject::where('subject_id',$attmaster->subject_id)
            ->where('sessn_id',$sessn->id)
            ->pluck('enroll_id');
        $student_ids = Enroll::whereIn('id',$enroll_ids)->pluck('student_id');
        $students = Student::whereIn('id',$student_ids)->get();

        $data = [
            'subject' => $attmaster->subject,
            'students' => $students
        ];
        return $data;

    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
