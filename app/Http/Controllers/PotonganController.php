<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\potongan;
use DB;

class PotonganController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:potongan-list|potongan-create|potongan-edit|potongan-delete', ['only' => ['index','store']]);
        $this->middleware('permission:potongan-create', ['only' => ['create','store']]);
        $this->middleware('permission:potongan-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:potongan-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $potongan = potongan::orderBy('id','DESC')->paginate();
        return view('potongan.index', compact('potongan'))
            ->with('i', ($request->input('page', 1) -1) * 5);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function add()
    // {
    //     return view('admin.permission.add-permission');
    // }
    public function create(Request $request)
    {
        $potongan = potongan::get();
        return view('potongan.add-potongan', compact('potongan'));
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
            'name' => 'required',
            'besar_potongan' => 'required',
        ]);
        $input = $request->all();
        potongan::create($input);

        return redirect()->route('potongan.index')->with('success','Berhasil menambah potongan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $potongan = potongan::find($id);
        return view('potongan.show',compact('potongan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $potongan = potongan::find($id);
        return view('potongan.edit-potongan',compact('potongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'besar_potongan' => 'required',
        ]);
        
        $potongan = potongan::find($id);
        $potongan->name = $request->input('name');
        $potongan->besar_potongan = $request->input('besar_potongan');    
        $potongan->save();
    
        return redirect()->route('potongan.index')
                        ->with('success','Berhasil update potongan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id->delete();
    
        return redirect()->route('potongan.index')
                        ->with('success','Berhasil hapus potongan');
    }
}
