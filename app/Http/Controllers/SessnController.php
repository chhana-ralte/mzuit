<?php

namespace App\Http\Controllers;

use App\Models\Sessn;
Use App\Models\CurrentSessn;
use Illuminate\Http\Request;

class SessnController extends Controller
{
    public function index()
    {
        return view('common.sessn.index',['sessns' => Sessn::orderby('start_yr','desc')->orderBy('odd_even','desc')->paginate()]);
    }

    public function create()
    {
        return view('common.sessn.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        if(isset($request->type) && $request->type=="default_sessn"){
            $sessn = CurrentSessn::find(1);
            $sessn->update(['current_sessn' => $request->sessn_id ]);
            return "Current session updated";
        }
        else{
            Sessn::updateOrCreate([
                'start_yr' => $request->start_yr,
                'odd_even' => $request->odd_even
            ],[
                'start_yr' => $request->start_yr,
                'end_yr' => $request->start_yr+1,
                'odd_even' => $request->odd_even
            ]);
            return redirect('/sessn')->with(['message' => ['type' => 'info', 'text' => 'Session created..']]);    
        }
    }

    public function show(Sessn $sessn)
    {
        //dd(auth()->user());
        if(auth()->user()->department_id){
            $department = auth()->user()->department();
        }
        //dd($department);
        $enrolls = \App\Models\Enroll::where('sessn_id',$sessn->id)
            ->whereIn('course_id',$department->courses->pluck('id'))
            ->get();
         // dd($enrolls);  
        $enroll_subject = \App\Models\Enroll_Subject::whereIn('enroll_id',$enrolls->pluck('id'))
            ->get();
        $subjects = \App\Models\Subject::whereIn('id',$enroll_subject->pluck('subject_id'))
            ->orderBy('semester')
            ->get();
       // dd($subjects);
        $data = [
            'department' => $department,
            'subjects' => $subjects,
            'sessn' => $sessn
        ];
        return view('common.sessn.show',$data);
    }

    public function edit(Sessn $sessn)
    {
        //
    }

    public function update(Request $request, Sessn $sessn)
    {
        //
    }

    public function destroy(Sessn $sessn)
    {
        //
    }
}
