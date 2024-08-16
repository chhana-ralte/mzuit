<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        return view('common.syllabus.index',['course'=>$course]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('common.syllabus.create',['course'=>$course]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Course $course, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'from_batch' => ['required','numeric','min:2000','max:2050'],
            'to_batch' => ['required','numeric','min:2000','max:2050']
        ]);

        Syllabus::create([
            'course_id' => $course->id,
            'name' => $request->name,
            'from_batch' => $request->from_batch,
            'to_batch' => $request->to_batch
        ]);

        return redirect('/course/' . $course->id)->with(['message' => ['type'=>'info', 'text'=>'New Syllabus created']]);
    }

    /**
     * Display the specified resource.
     */
    public function show($syllabus_id)
    {
        $syllabus = Syllabus::findOrFail($syllabus_id);
        $subjects = Subject::where('syllabus_id',$syllabus->id)->orderBy('semester')->get();
        return view('common.syllabus.show',['syllabus'=>$syllabus, 'subjects'=>$subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Syllabus $syllabu)
    {
        return view('common.syllabus.edit',['syllabus'=>$syllabu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Syllabus $syllabu)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'from_batch' => ['required','numeric','min:2000','max:2050'],
            'to_batch' => ['required','numeric','min:2000','max:2050']
        ]);

       $syllabu->update([
            'name' => $request->name,
            'from_batch' => $request->from_batch,
            'to_batch' => $request->to_batch
        ]);

        return redirect('/course/' . $syllabu->course->id . '/syllabus')->with(['message' => ['type'=>'info', 'text'=>'Syllabus updated']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($syllabus_id)
    {
        $syllabus = Syllabus::findOrFail($syllabus_id);
        $course_id = $syllabus->course_id;
        $syllabus->delete();

        return redirect('/course/' . $course_id . '/syllabus')->with(['message' => ['type'=>'info', 'text'=>'Syllabus deleted']]);
    }
}
