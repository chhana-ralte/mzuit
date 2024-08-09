<?php

namespace App\Http\Controllers;

use App\Models\Sessn;
Use App\Models\CurrentSessn;
use Illuminate\Http\Request;

class SessnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('common.sessn.index',['sessns' => Sessn::orderby('start_yr')->orderBy('odd_even')->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $last_sessn = Sessn::last();
        // dd($last_sessn);
        return view('common.sessn.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Sessn $sessn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sessn $sessn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sessn $sessn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sessn $sessn)
    {
        //
    }
}
