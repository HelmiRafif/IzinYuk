<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\jabatan;
use DB;

class JabatanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:jabatan-list|jabatan-create|jabatan-edit|jabatan-delete', ['only' => ['index','store']]);
        $this->middleware('permission:jabatan-create', ['only' => ['create','store']]);
        $this->middleware('permission:jabatan-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:jabatan-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $jabatan = Jabatan::orderBy('id','ASC')->paginate();
        return view('jabatan.index', compact('jabatan'))
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
        $jabatan = jabatan::get();
        return view('jabatan.add-jabatan', compact('jabatan'));
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
        jabatan::create($input);

        return redirect()->route('jabatan.index')->with('success','Berhasil menambah jabatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jabatan = jabatan::find($id);
        return view('jabatan.show',compact('jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatan = jabatan::find($id);
        return view('jabatan.edit-jabatan',compact('jabatan'));
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
        
        $jabatan = Jabatan::find($id);
        $jabatan->name = $request->input('name');
        $jabatan->gaji_pokok = $request->input('gaji_pokok');
        $jabatan->bonus_profesional = $request->input('bonus_profesional');
        $jabatan->save();
    
        return redirect()->route('jabatan.index')
                        ->with('success','Berhasil update jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("jabatans")->where('id',$id)->delete();
    
        return redirect()->route('jabatan.index')
                        ->with('success','Berhasil hapus jabatan');
    }

}
