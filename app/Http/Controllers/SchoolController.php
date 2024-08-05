<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    public function index()
    {
        return view('common.school.index',['schools' => School::all()]);
    }

    public function create()
    {
        
        return view('common.school.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required','min:3'],
            'name' => 'required'
        ]);
        $school = School::create($validated);
        //return redirect('/school');
        $message = ['type'=>'info', 'text'=>'School Created Successfully'];
        return redirect()->route('school.create')->with('message', $message);
    }

    public function show(School $school)
    {
        return view('common.school.show',['school' => $school]);
    }

    public function edit(School $school)
    {
        return view('common.school.edit',['school' => $school]);
    }

    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'code' => ['required','min:3'],
            'name' => 'required'
        ]);
        $school->update($validated);
        $message = ['type' => 'info', 'text' => 'School is updated'];
        return redirect('/school/' . $school->id)->with('message', $message);
    }

    public function destroy(School $school)
    {
        $school->delete();
        //Session::flash('message',['type' => 'info', 'text' => 'School is deleted']);
        $message = ['type' => 'info', 'text' => 'School is deleted'];
        return redirect('/school')->with('message', $message);
    }
}
