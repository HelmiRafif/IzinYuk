<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\izin;
use App\Models\pegawai;

class IzinController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:izin-list|izin-create|izin-edit|izin-delete', ['only' => ['index','store']]);
        $this->middleware('permission:izin-create', ['only' => ['create','store']]);
        $this->middleware('permission:izin-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:izin-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $izin = Izin::orderBy('id','DESC')->paginate(30);
        return view('izin.index',compact('izin'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $izin = izin::get();        
        return view('izin.add-izin', compact('izin'));
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
            'email' => 'required',
        ]);
        $input = $request->all();
        izin::create($input);

        return redirect()->route('izin.index')->with('success','Berhasil menambah izin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $izin = izin::find($id);
        return view('izin.show',compact('izin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $izin = izin::find($id);
        return view('izin.edit-izin',compact('izin'));
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
            'email' => 'required',
        ]);
        
        $izin = Jabatan::find($id);
        $izin->name = $request->input('name');
        $izin->email = $request->input('email');
        $izin->bonus_profesional = $request->input('bonus_profesional');
        $izin->save();
    
        return redirect()->route('izin.index')
                        ->with('success','Berhasil update izin');
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
    
        return redirect()->route('izin.index')
                        ->with('success','Berhasil hapus izin');
    }
}
