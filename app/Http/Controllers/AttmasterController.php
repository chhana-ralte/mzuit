<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attmaster;
use App\Models\Attendance;
use App\Models\Sessn;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Enroll;
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
        if(isset($_GET['subject'])){
            $subject = Subject::findOrFail($_GET['subject']);
        }
        else{
            $subject = false;
        }

        $teacher = Teacher::find($user->teacher_id);

        $subjects = $teacher->subjects()
            ->where('sessn_id',$sessn->id)
            ->get();
        if($subject){
            $attmasters = Attmaster::where('user_id',$user->id)
            ->where('sessn_id',$sessn->id)
            ->where('subject_id',$subject->id)
            ->orderBy('dt')
            ->get();
        }
        else{
            $attmasters = false;
        }
        $data = [
            'subject' => $subject,
            'subjects' => $subjects,
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
        if(isset($_GET['subject'])){
            $subject = Subject::findOrFail($_GET['subject']);
        }
        else{
            abort(404);
        }
        $data = [
            'sessn' => $sessn,
            'user' => $user,
            'subject' => $subject,
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
        return redirect("/user/" . $user->id . "/attmaster?subject=" . $request->subject_id)
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
            ->pluck('enroll_id');
        $student_ids = Enroll::whereIn('id',$enroll_ids)
            ->where('sessn_id',$sessn->id)
            ->pluck('student_id');
        $students = Student::whereIn('id',$student_ids)->get();

        $attendances = $attmaster->attendances;
        $atts = [];
        $id=0;
        foreach($attendances as $att){
            $atts[$att->student_id] = $att->status;
        }
        $stds = [];
        foreach($students as $st){
            array_push($stds,[
                'id'=>$st->id,
                'rollno'=>$st->rollno,
                'name' => $st->person->name,
                'status' => isset($atts[$st->id])?$atts[$st->id]:0
            ]);
        }
        $data = [
            'attmaster' => $attmaster,
            'students' => $stds,
        ];
        return view('attmaster.show',$data);

    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Attmaster $attmaster)
    {
        foreach($request->students as $key=>$value){
            if($value == 1){
                Attendance::updateOrCreate([
                    'attmaster_id' => $attmaster->id,
                    'student_id' => $key
                ],[
                    'attmaster_id' => $attmaster->id,
                    'student_id' => $key,
                    'status' => 1
                ]);    
            }
            else{
                Attendance::where('attmaster_id',$attmaster->id)
                    ->where('student_id',$key)
                    ->delete();
            }
        }
        return redirect("/attmaster/" . $attmaster->id)
            ->with(['message' => ['type'=>'info', 'text'=>"Attendance updated"]]);

    }

    public function destroy(string $id)
    {
        //
    }
}
