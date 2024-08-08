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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('common.enroll.edit',['enroll'=>$enroll]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enroll $enroll)
    {
        if($request->updateType == "personal"){
            $enroll->student->person->update([
                'name' => $request->name,
                'father' => $request->father,
                'dob' => $request->dob,
                'category' => $request->category
            ]);
        }
        else if($request->updateType == "student"){
            $sessn = \App\Models\Sessn::where('start_yr',$request->batch)->first();
            $enroll->student->update([
                'rollno' => $request->rollno,
                'type' => $request->type,
                'registration' => $request->registration,
                'sessn_id' => $sessn?$sessn->id:0
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
