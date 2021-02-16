<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pegawai;
use App\Models\jabatan;
use Illuminate\Support\Facades\Auth;
use App\Models\permission;
use DB;

class PegawaiController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pegawai-create', ['only' => ['create','store']]);
        $this->middleware('permission:pegawai-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $pegawai = Pegawai::orderBy('id','DESC')->paginate(25);
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
        $jabatan = jabatan::get()->toArray();        
        return view('pegawai.add-pegawai', compact('jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $session_id = session()->get('users')->id;
        // dd($session_id);
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'rekening' => 'required',
            'type_pegawai' => 'required',
            'bank_id' => 'required',
            'jabatan_id' => 'required'
        ]);
        $data = new pegawai([
            'nama' => $request->get('nama'),
            'email' => $request->get('email'),
            'alamat' => $request->get('alamat'),
            'rekening' => $request->get('rekening'),
            'type_pegawai' => $request->get('type_pegawai'),
            'bank_id' => $request->get('bank_id'),
            'jabatan_id' => $request->get('jabatan_id'),
            // 'session_id' => $session_id->get()
            ]);
        $data['user_id'] = Auth::user()->id;        
        $data->save();



        // $this->validate($request, [
        //     'nama' => 'required',
        //     'email' => 'required',
        //     'alamat' => 'required',
        //     // 'tanggal_masuk' => 'required',
        //     'rekening' => 'required',
        //     'type_pegawai' => 'required',
        //     'bank_id' => 'required',
        //     // 'jabatan_id' => 'required',
        // ]);
        // $input = $request->all();
        // pegawai::create($input);
        
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
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
            'rekening' => 'required',
            'type_pegawai' => 'required',
            'bank_id' => 'required',
            'jabatan_id' => 'required',
        ]);
        
        $pegawai = Jabatan::find($id);
        $pegawai->name = $request->input('name');
        $pegawai->email = $request->input('email');
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
        DB::table("pegawais")->where('id',$id)->delete();
    
        return redirect()->route('pegawai.index')
                        ->with('success','Berhasil hapus pegawai');
    }
}

