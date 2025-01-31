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
            'dikteis'=>$dikteis,
            'departments' => Department::has('dtcourses')->orderBy('code')->get()
        ];
        return view('diktei.list',$data);
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

    public function store(){
        //return ['imj'=>request()->imj, 'imn'=>request()->imn ];
        $diktei = Diktei::find(request()->diktei_id);
        $imjallotted = 0;
        foreach(request()->imj as $key=>$imj){
            if($imj ==0)
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
        return redirect('/diktei/entry/' . request()->diktei_id);
    }

    public function deptslotentry(){
        $departments = Department::whereNotIn('school_id',[4,8])->orderBy('name')->get();
        return view('diktei.deptslotentry',['departments'=>$departments]);
    }

    public function deptslotentrystore(){
        //dd(request()->all());

        foreach(request()->department as $dep_id=>$slot){
            Deptslot::updateOrCreate([
                'department_id' => $dep_id
            ],
            [
                'department_id' => $dep_id,
                'slot' => $slot
            ]);
        }
        return redirect('/diktei/deptslotentry')->with(['message' => ['type'=>'info', 'text'=>'Updated']]);
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
        Allot::truncate();
        foreach(Diktei::orderBy('id')->get() as $diktei){
            foreach(Option::where('diktei_id',$diktei->id)->orderBy('option')->get() as $opt){
                $department = Department::find($opt->department_id);
                $allotted = $department->allotted();
                if($allotted < $department->slot()){
                    Allot::updateOrCreate([
                        'diktei_id' => $diktei->id
                    ],
                    [
                        'diktei_id' => $diktei->id,
                        'department_id' => $department->id
                    ]
                    );
                    $allot_dept = $department;
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
        /*
        if(isset($_GET['dept_id'])){
            $department = Department::findOrFail($_GET['dept_id']);
            $dikteis = Diktei::whereNotIn('id',Allot::all()->pluck('diktei_id'))
            ->where('department_id',$department->id)
            ->paginate()
            ->withQueryString();
        }
        else{
            $dikteis = Diktei::whereNotIn('id',Allot::all()->pluck('diktei_id'))
            ->paginate()
            ->withQueryString();
        }
        */
        $departments = Department::has('dtcourses')->orderBy('code')->get();
        if(isset($_GET['dept_id'])){
            $department = Department::findOrFail($_GET['dept_id']);
            $dtunalotted = Diktei::whereNotIn('id',Dtallot::where('major',1)->pluck('diktei_id'))
                ->orWhereNotIn('id',Dtallot::where('major',0)->pluck('diktei_id'))
                ->where('department_id',$department->id)
                ->paginate()
                ->withQueryString();
        }
        else{
            $dtunalotted = Diktei::whereNotIn('id',Dtallot::where('major',1)->pluck('diktei_id'))
                ->orWhereNotIn('id',Dtallot::where('major',0)->pluck('diktei_id'))
                ->paginate()
                ->withQueryString();
        }
        //$imnunallotted = Diktei::whereNotIn('id',Dtallot::where('major',0)->pluck('diktei_id'));
        
        $data = [
            'departments' => $departments,
            'dtunalotted' => $dtunalotted,
        ];
        return view('diktei.unallotted',$data);
    }

    public function searchresults(){
        $str = $_GET['search'];
        $dikteis = Diktei::where('name','like','%' . $str . '%')->paginate()->withQueryString();
        return view('diktei.search');
    }
    
    public function clear(Diktei $diktei){
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
        $imjs = Dtcourse::where('major',1)->get();
        return $imjs;
    }
}
