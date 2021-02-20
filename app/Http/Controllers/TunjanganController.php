<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tunjangan;
use DB;

class TunjanganController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tunjangan-list|tunjangan-create|tunjangan-edit|tunjangan-delete', ['only' => ['index','store']]);
        $this->middleware('permission:tunjangan-create', ['only' => ['create','store']]);
        $this->middleware('permission:tunjangan-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tunjangan-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tunjangans = tunjangan::orderBy('id','DESC')->paginate();
        return view('tunjangan.index',compact('tunjangans'))
            ->with('i', ($request->input('page', 1) - 1) * 5);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function add()
    // {
    //     return view('tunjangan.add-tunjangan');
    // }
    public function create(Request $request)
    {
        $tunjangan = tunjangan::get();
        return view('tunjangan.add-tunjangan', compact('tunjangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tunjangans,name',
            'besar_tunjangan' => 'required',
        ]);

        tunjangan::create(['name' => $request->input('name'), 'besar_tunjangan' => $request->input('besar_tunjangan')]);
        return redirect()->route('tunjangan.index')->with('success','tunjangan created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tunjangan  $tunjangan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tunjangan  $tunjangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tunjangan = tunjangan::find($id);
        return view('tunjangan.edit-tunjangan',compact('tunjangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tunjangan  $tunjangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tunjangan $tunjangan)
    {
        request()->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);
    
        $tunjangan->update($request->all());
    
        return redirect()->route('tunjangan.index')
                        ->with('success','tunjangan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tunjangan  $tunjangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(tunjangan $tunjangan)
    {
        $tunjangan->delete();
    
        return redirect()->route('tunjangan.index')
                        ->with('success','tunjangan deleted successfully');
    }
}
