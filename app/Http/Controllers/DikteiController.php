<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diktei;
use App\Models\Option;
use App\Models\Department;
use App\Models\School;
use App\Models\Deptslot;
use App\Models\Allot;

class DikteiController extends Controller
{
    public function index(){
        $departments = Department::whereNotIn('school_id',[4,8])
            ->orderBy('name')
            ->get();
        return view('diktei.dashboard',['departments'=>$departments]);
    }

    public function home(){
        if(isset($_GET['dept_id'])){
            $department = Department::findOrFail($_GET['dept_id']);
            $dikteis = Diktei::where('department_id',$department->id)->paginate(50)->withQueryString();
        }
        else{
            $dikteis = Diktei::paginate(15)->withQueryString();
        }
        
        return view('diktei.home',['dikteis'=>$dikteis]);
    }

    public function show(Diktei $diktei){
        return view('diktei.show',['diktei' => $diktei]);
    }

    public function destroy(Diktei $diktei){
        Option::where('diktei_id',$diktei->id)->delete();
        Allot::where('diktei_id',$diktei->id)->delete();
        $diktei->delete();
        return redirect('/diktei/home')->with(['message' => ['type'=>'info', 'text'=>'Deleted']]);
    }

    public function entry(){
        $validated = request()->validate([
            'name' => ['required'],
            'rollno' => ['required'],
            'department' => ['required']
        ]);
        $diktei = Diktei::where('rollno',request()->rollno)->first();
        if(!$diktei){
            $diktei = Diktei::create([
                'rollno' => request()->rollno,
                'name' => request()->name,
                'department_id' => request()->department
            ]);
        }
        else{
            $diktei->update([
                'name' => request()->name,
                'department_id' => request()->department
            ]);
        }
        return redirect('/diktei/entry/' . $diktei->id);
    }

    public function option(Diktei $diktei){
        if(Option::where('diktei_id',$diktei->id)->exists()){
            return view('diktei.option',['diktei'=>$diktei,'done'=>1]);
        }
        else{
            $departments = Department::whereNot('school_id',$diktei->department->school->id)
                ->whereNotIn('school_id',[4,8])
                ->orderBy('name')->get();
            return view('diktei.option',['diktei'=>$diktei, 'departments'=>$departments, 'done'=>0]);
        }
        
    }

    public function store(){
        foreach(request()->department as $key=>$dep){
            if($dep ==0)
                break;
            Option::updateOrCreate([
                'diktei_id' => request()->diktei_id,
                'option' => $key+1
            ],
            [
                'diktei_id' => request()->diktei_id,
                'option' => $key+1,
                'department_id' => $dep
            ]);
        }
        $options = Option::where('diktei_id',request()->diktei_id)->orderBy('option')->get();
        $allot_dept = null;
        foreach($options as $opt){
            $department = Department::find($opt->department_id);
            $allotted = $department->allotted();
            if($allotted < $department->slot()){
                Allot::updateOrCreate([
                    'diktei_id' => request()->diktei_id
                ],
                [
                    'diktei_id' => request()->diktei_id,
                    'department_id' => $department->id
                ]
                );
                $allot_dept = $department;
                break;
            }
        }
        return redirect('/diktei/entry/' . request()->diktei_id);
    }

    public function deptslotentry(){
        $departments = Department::whereNotIn('school_id',[4,8])->orderBy('name')->get();
        return view('diktei.deptslotentry',['departments'=>$departments]);
    }
    public function deptslotentrystore(){
        //dd(request()->all());
        $str = "";
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
        $departments = Department::whereNotIn('school_id',[4,8])->orderBy('name')->get();
        return view('diktei.allotments',['departments'=>$departments]);
    }

    public function allotments_dept(Department $department){
        $allots = Allot::where('department_id',$department->id)->get();

        return view('diktei.allotments-dept',['department'=>$department, 'allots'=>$allots]);
    }

    public function algorithm(){
        Allot::truncate();
        foreach(Diktei::orderBy('id')->get() as $diktei){
            foreach($diktei->options as $opt){
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
        return redirect('/diktei/allotments');
    }
}
