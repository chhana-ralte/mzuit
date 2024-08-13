<?php

namespace App\Http\Controllers;

use App\Models\Subject_Teacher;
use Illuminate\Http\Request;
use App\Models\Sessn;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Person;
use App\Models\Teacher;


class SubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject, Sessn $sessn)
    {
        //dd($department);
        $data = [
            'subject' => $subject,
            'subject_teachers' => Subject_Teacher::where('subject_id',$subject->id)->where('sessn_id',$sessn->id)->get(),
            'sessn' => $sessn
        ];
        return view('common.subject_teacher.index',$data);
    }

    public function create(Subject $subject, Sessn $sessn)
    {
        return view('common.subject_teacher.create',['subject'=>$subject, 'sessn'=>$sessn]);
    }

    public function searchResults(){
        //return ;
        $person_ids = Person::where('name','like','%' . $_GET['search'] . '%')->pluck('id');
        $teachers = Teacher::whereIn('person_id',$person_ids)->get();
        $tchs = [];
        foreach($teachers as $t){
            array_push($tchs,['name'=>$t->person->name, 'id'=>$t->id, 'department'=>$t->department->name]);
        }
        return $tchs;
    }
    public function store(Subject $subject, Sessn $sessn)
    {
        foreach(request()->teachers as $t){
            Subject_Teacher::updateOrCreate([
                'subject_id' => $subject->id,
                'teacher_id' => $t,
                'sessn_id' => $sessn->id
            ],[
                'subject_id' => $subject->id,
                'teacher_id' => $t,
                'sessn_id' => $sessn->id
            ]);
        }
        
        return redirect('/subject_teacher/' . $subject->id . "/" . $sessn->id)
            ->with(['message' => ['type'=>'info', 'text'=>'Added Successfully']]);
    }

    public function show(Subject_Teacher $subject_Teacher)
    {
        //
    }

    public function edit(Subject_Teacher $subject_Teacher)
    {
        //
    }

    public function update(Request $request, Subject_Teacher $subject_Teacher)
    {
        //
    }

    public function destroy(Subject_Teacher $subject_teacher)
    {
        $path = '/subject_teacher/' . $subject_teacher->subject->id . '/' . $subject_teacher->sessn->id;
        $subject_teacher->delete();
        return redirect($path)
            ->with(['message'=>['type'=>'info', 'text'=>'Teacher deleted']]);
    }
}
