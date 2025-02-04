<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diktei;
use App\Models\Option;
use App\Models\Department;
use App\Models\School;
use App\Models\Deptslot;
use App\Models\Allot;
use App\Models\Dtcourse;
use App\Models\Dtoption;
use App\Models\Dtallot;

use Carbon;

class DikteiController extends Controller
{
    public function index(){
        //return "Hehe";
        //$departments = Department::whereNotIn('school_id',[4,8])
        //    ->orderBy('name')
        //    ->get();

        //$departments = Department::has('dtcourses')
        //    ->orderBy('name')
        //    ->get();
            
        //return $departments;
        return view('diktei.index');
        return view('diktei.dashboard',['departments'=>$departments]);
    }

    public function list(){

        if(isset($_GET['dept_id'])){
            $department = Department::findOrFail($_GET['dept_id']);
            $dikteis = Diktei::where('department_id',$department->id)->paginate()->withQueryString();
        }
        else{
            $dikteis = Diktei::paginate()->withQueryString();
        }
        $data = [
            'dikteis' => $dikteis,
            'departments' => Department::has('dtcourses')->orderBy('code')->get()
        ];    
        
        if(isset($department)){
            $data['department'] = $department;
        }
        
        return view('diktei.list',$data);
    }

    public function create(){
        if(isset($_GET['dept_id'])){
            $dept = Department::find($_GET['dept_id']);
        }
        $departments = Department::orderBy('name')->get();
        $data = [
            'departments' => $departments
        ];
        if(isset($dept)){
            $data['department'] = $dept;
        }
        return view('diktei.create', $data);
    }

    public function store(Request $request){
        $rollno = trim($request->rollno);

        while($rollno != str_replace(' ','',$rollno)){
            $rollno = str_replace(' ','',$rollno);
        }

        if(Diktei::where('rollno',$rollno)->exists()){
            return redirect('/diktei/create')
                ->with(['message' => ['type' => 'info', 'text' => 'Student already exists']])
                ->withInput();
        }

        $request->validate([
            'name' => 'required',
            'rollno' => 'required',
            'department' => 'required'
        ]);

        Diktei::create([
            'name' => $request->name,
            'rollno' => $request->rollno,
            'department_id' => $request->department
        ]);
    
        return redirect('/diktei/create?dept_id=' . $request->department)
            ->with(['message' => ['type' => 'info', 'text' => 'Successfully inserted']]);
        
    }
    public function show(Diktei $diktei){
        $imjoptions = Dtoption::where('diktei_id',$diktei->id)->where('major',1)->get();
        $imnoptions = Dtoption::where('diktei_id',$diktei->id)->where('major',0)->get();
        $majors = Dtcourse::where('major',1)->where('department_id','<>',$diktei->department_id)->get();
        $minors = Dtcourse::where('major',0)->where('department_id','<>',$diktei->department_id)->get();
        $data = [
            'imjoptions' => $imjoptions,
            'imnoptions' => $imnoptions,
            'majors' => $majors,
            'minors' => $minors,
            'diktei' => $diktei
        ];
        return view('diktei.show',$data);
    }

    public function edit(Diktei $diktei){
        $departments = Department::orderBy('name')->get();

        return view('diktei.edit',['diktei' => $diktei,'departments' => $departments]);
    }

    public function update(Request $request, Diktei $diktei){
        
        $rollno = trim($request->rollno);

        while($rollno != str_replace(' ','',$rollno)){
            $rollno = str_replace(' ','',$rollno);
        }

        if(Diktei::where('rollno',$rollno)->where('rollno','<>',$diktei->rollno)->exists()){
            return redirect('/diktei/' . $diktei->id . '/edit')
                ->with(['message' => ['type' => 'info', 'text' => 'Student already exists']]);
        }

        $request->validate([
            'name' => 'required',
            'rollno' => 'required',
            'department' => 'required'
        ]);

        $diktei->update([
            'name' => $request->name,
            'rollno' => $request->rollno,
            'department_id' => $request->department
        ]);
    
        return redirect('/diktei/' . $diktei->id)
            ->with(['message' => ['type' => 'info', 'text' => 'Successfully updated']]);
    }

    public function destroy(Diktei $diktei){
        Dtoption::where('diktei_id',$diktei->id)->delete();
        Dtallot::where('diktei_id',$diktei->id)->delete();
        $diktei->delete();
        return redirect('/diktei/list')->with(['message' => ['type'=>'info', 'text'=>'Deleted']]);
    }

    public function entry(){
        return view('diktei.entry');
    }

    public function post_entry(){
        $validated = request()->validate([
            //'name' => ['required'],
            'rollno' => ['required'],
            //'department' => ['required']
        ]);

        $diktei = Diktei::where('rollno',request()->rollno)->first();
        if(!$diktei){
            // $diktei = Diktei::create([
            //    'rollno' => request()->rollno,
            //    'name' => request()->name,
            //    'department_id' => request()->department
            // ]);
            return redirect('/diktei/entry')->with(['message' => ['type' => 'info', 'text' => 'Roll number is not found']])->withInput();
        }
        // else{
        //     $diktei->update([
        //         'name' => request()->name,
        //         'department_id' => request()->department
        //     ]);
        // }

        return redirect('/diktei/entry/' . $diktei->id);
    }

    public function option(Diktei $diktei){
        if(Dtoption::where('diktei_id',$diktei->id)->exists()){
            $imjoptions = Dtoption::where('diktei_id',$diktei->id)
                ->where('major', 1)
                ->orderBy('option')
                ->get();
            $imnoptions = Dtoption::where('diktei_id',$diktei->id)
                ->where('major', 0)
                ->orderBy('option')
                ->get();
            //return $options;
            $data = [
                'diktei'=>$diktei,
                'done'=>1, 
                'imjoptions'=>$imjoptions,
                'imnoptions'=>$imnoptions
            ];
            return view('diktei.option',$data);
        }
        else{
            $departments = Department::whereNot('id',$diktei->department->id)
                ->orderBy('name')->get();
            $majors = Dtcourse::whereNot('department_id',$diktei->department->id)->where('major',1)->get();
            $minors = Dtcourse::whereNot('department_id',$diktei->department->id)->where('major',0)->get();
            $data = [
                'diktei' => $diktei,
                'majors' => $majors,
                'minors' => $minors,
                'done' => 0
            ];
            return view('diktei.option',$data);
        }
        
    }

    public function students(){
        //return "Hehe";
        if(isset($_GET['dept_id'])){
            $department = Department::findOrFail($_GET['dept_id']);
            $dikteis = Diktei::where('department_id',$department->id)->get();
        }
        $data = [
            'departments' => Department::has('dtcourses')->orderBy('name')->get()
        ];    
        
        if(isset($department)){
            $data['department'] = $department;
            $data['dikteis'] = $dikteis;
        }
        
        return view('diktei.student',$data);
    }
    public function option_store(){
        //return ['imj'=>request()->imj, 'imn'=>request()->imn ];

        $imjs = array();
        $err = 0;
        foreach(request()->imj as $key => $imj){
            if($imj == 0){
                $err = 1;
                $text = "Choose all 10 options in IMJ";
                break;
            }
            else if(isset($imjs[$imj])){
                $err =1;
                $text = "Duplicate entry detected in IMJ";
                break;
            }
            else{
                $imjs[$imj] = 1;
            }
        }
        //return $str;
        if(!$err){

    
            $imns = array();
            $err = 0;
            foreach(request()->imn as $key=>$imn){
                if($imn == 0){
                    $err = 1;
                    $text = "Choose all 10 options in IMN";
                    break;
                }
                else if(isset($imns[$imn])){
                    $err = 1;
                    $text = "Duplicate entry detected in IMN";
                }
                else{
                    $imns[$imn] = 1;
                }
            }
        }
        if($err){
            return redirect()->back()->with(['message' => ['type' => 'info', 'text' => $text]])->withInput();
        }


        $diktei = Diktei::find(request()->diktei_id);
        $imjallotted = 0;
        foreach(request()->imj as $key=>$imj){
            if($imj == 0)
                break;
            Dtoption::updateOrCreate([
                'diktei_id' => request()->diktei_id,
                'option' => $key+1,
                'major' => 1,
            ],
            [
                'diktei_id' => request()->diktei_id,
                'option' => $key+1,
                'dtcourse_id' => $imj,
                'major' =>1
            ]);
            if($imjallotted == 0){
                $dtcourse = Dtcourse::find($imj);
                if($dtcourse->vacant() > 0){
                    Dtallot::create([
                        'diktei_id' => request()->diktei_id,
                        'dtcourse_id' => $imj,
                        'major' => 1
                    ]);
                    $imjallotted = 1;
                }
            }
        }
        //{"imj":["5","17","11","0","0","0","0","0","0","0"],"imn":["8","12","20","0","0","0","0","0","0","0"]}

        $imnallotted = 0;
        foreach(request()->imn as $key=>$imn){
            if($imn ==0)
                break;
            Dtoption::updateOrCreate([
                'diktei_id' => request()->diktei_id,
                'option' => $key+1,
                'major' => 0
            ],
            [
                'diktei_id' => request()->diktei_id,
                'option' => $key+1,
                'dtcourse_id' => $imn,
                'major' => 0
            ]);
            if($imnallotted == 0){
                $dtcourse = Dtcourse::find($imn);
                if($dtcourse->vacant() > 0){
                    Dtallot::create([
                        'diktei_id' => request()->diktei_id,
                        'dtcourse_id' => $imn,
                        'major' => 0
                    ]);
                    $imnallotted = 1;
                }
            }
        }
        $diktei->update([
            'dt_time' => Carbon\Carbon::now()
        ]);
        return redirect('/diktei/entry/' . request()->diktei_id)
            ->with(['message' => ['type' => 'info', 'text' => 'Successfully done']]);
    }

    public function allotments(){
        $dtcourses = Dtcourse::all();
        return view('diktei.allotments',['dtcourses'=>$dtcourses]);
    }

    public function allotments_dtcourse(Dtcourse $dtcourse){
        $dtallots = Dtallot::where('dtcourse_id',$dtcourse->id)->get();

        return view('diktei.allotments-dtcourse',['dtcourse'=>$dtcourse, 'dtallots'=>$dtallots]);
    }

    public function algorithm(){
        return view('diktei.algorithm');
    }

    public function algorithm_execute(){
        Dtallot::truncate();
        foreach(Diktei::orderBy('dt_time')->get() as $diktei){
            foreach(Dtoption::where('diktei_id',$diktei->id)->where('major',1)->orderBy('option')->get() as $opt){
                $dtcourse = Dtcourse::find($opt->dtcourse_id);
                if($dtcourse->vacant() > 0){
                    Dtallot::updateOrCreate([
                        'diktei_id' => $diktei->id,
                        'major' => 1
                    ],
                    [
                        'diktei_id' => $diktei->id,
                        'major' => 1,
                        'dtcourse_id' => $dtcourse->id
                    ]
                    );
                    break;
                }
            }
            foreach(Dtoption::where('diktei_id',$diktei->id)->where('major',0)->orderBy('option')->get() as $opt){
                $dtcourse = Dtcourse::find($opt->dtcourse_id);
                if($dtcourse->vacant() > 0){
                    Dtallot::updateOrCreate([
                        'diktei_id' => $diktei->id,
                        'major' => 0
                    ],
                    [
                        'diktei_id' => $diktei->id,
                        'major' => 0,
                        'dtcourse_id' => $dtcourse->id
                    ]
                    );
                    break;
                }
            }
        }
        return redirect('/diktei/allotments')->with(['message' => ['type'=>'info', 'text'=>'Algorithm executed successfully.']]);
    }

    public function search(){
        if(isset($_GET['search'])){
            $str = $_GET['search'];
            $dikteis = Diktei::where('name','like','%' . $str . '%')->paginate()->withQueryString();
            return view('diktei.search',['dikteis'=>$dikteis,'str'=>$str]);
        }
        else{
            return view('diktei.search',['str'=>'']);    
        }
    }

    public function unallotted(){
        $departments = Department::has('dtcourses')->orderBy('code')->get();

        $dtalotted = Diktei::whereIn('id',Dtallot::where('major',1)->pluck('diktei_id'))
            ->whereIn('id',Dtallot::where('major',0)->pluck('diktei_id'));
        
        if(isset($_GET['dept_id'])){
            $department = Department::findOrFail($_GET['dept_id']);

            $dtunalotted = Diktei::whereNotIn('id',$dtalotted->pluck('id'))
                ->where('department_id',$department->id)
                ->paginate()
                ->withQueryString();
        }
        else{
            $dtunalotted = Diktei::whereNotIn('id',$dtalotted->pluck('id'))
                ->paginate()
                ->withQueryString();
        }

        $data = [
            'departments' => $departments,
            'dtunalotted' => $dtunalotted,
        ];
        if(isset($department)){
            $data['department'] = $department;
        }
        return view('diktei.unallotted',$data);
    }

    public function searchresults(){
        $str = $_GET['search'];
        $dikteis = Diktei::where('name','like','%' . $str . '%')->paginate()->withQueryString();
        return view('diktei.search');
    }
    
    public function clear(Diktei $diktei){
        $diktei->update(['dt_time' => NULL]);
        Dtallot::where('diktei_id',$diktei->id)->delete();
        Dtoption::where('diktei_id',$diktei->id)->delete();

        return redirect('/diktei/' . $diktei->id)->with(['message' => ['type' => 'info', 'text' => 'Cleared the options.']]);
    }

    public function assigncourse(Diktei $diktei){
        //dd(request()->all());
        Dtallot::updateOrCreate([
            'diktei_id' => $diktei->id,
            'major' => request()->major
        ],
        [
            'diktei_id' => $diktei->id,
            'major' => request()->major,
            'dtcourse_id' => request()->dtcourse
        ]
        );
        if(request()->major){
            $str = "IMJ";
        }
        else{
            $str = "IMN";
        }
        return redirect('/diktei/' . $diktei->id)->with(['message' => ['type' => 'info', 'text' => 'Allotted to new ' . $str . ' course']]);
    }

    public function imjs(){
        if(isset($_GET['str'])){
            $str = explode(',',$_GET['str']);
        }

        $imjs = Dtcourse::where('major',1)->whereNotIn('id',$str)->get();
        return $imjs;
    }
    public function imns(){
        if(isset($_GET['str'])){
            $str = explode(',',$_GET['str']);
        }

        $imns = Dtcourse::where('major',0)->whereNotIn('id',$str)->get();
        return $imns;
    }
}
