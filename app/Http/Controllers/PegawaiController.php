<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pegawai;
use App\Models\permission;
use DB;

class PegawaiController extends Controller
{
    function __construct()
    {
        $this->middleware('pegawai:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete', ['only' => ['index','store']]);
        $this->middleware('pegawai:pegawai-create', ['only' => ['create','store']]);
        $this->middleware('pegawai:pegawai-edit', ['only' => ['edit','update']]);
        $this->middleware('pegawai:pegawai-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $products = Pegawai::orderBy('id','DESC')->paginate(50);
        return view('pegawai.index',compact('pegawai'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pegawai = pegawai::get();
        return view('pegawai.add-pegawai', compact('pegawai'));
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
            'gaji_pokok' => 'required',
        ]);
        $input = $request->all();
        pegawai::create($input);

        return redirect()->route('pegawai.index')->with('success','Berhasil menambah pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = pegawai::find($id);
        return view('pegawai.show',compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = pegawai::find($id);
        return view('pegawai.edit-pegawai',compact('pegawai'));
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
            'gaji_pokok' => 'required',
        ]);
        
        $pegawai = Jabatan::find($id);
        $pegawai->name = $request->input('name');
        $pegawai->gaji_pokok = $request->input('gaji_pokok');
        $pegawai->bonus_profesional = $request->input('bonus_profesional');
        $pegawai->save();
    
        return redirect()->route('pegawai.index')
                        ->with('success','Berhasil update pegawai');
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
    
        return redirect()->route('pegawai.index')
                        ->with('success','Berhasil hapus pegawai');
    }
}

