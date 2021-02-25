<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pegawai;
use App\Models\jabatan;
use Illuminate\Support\Facades\Auth;
use App\Models\permission;
use App\Models\tunjangan;
use App\Models\tunjanganPegawai;
use DB;

class PegawaiController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pegawai-create', ['only' => ['create','store']]);
        $this->middleware('permission:pegawai-edit', ['only' => ['edit']]);
        $this->middleware('permission:pegawai-biodata|pegawai-edit|pegawai-tunjangan', ['only' => ['biodata','list','update']]);
        $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $pegawai = Pegawai::orderBy('id','ASC')->paginate();
        return view('pegawai.index',compact('pegawai'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function list()
    {
        $id = Auth::user()->id;
        $pegawai = pegawai::find($id);
        $show = DB::table('pegawais')->where('id',$id)->count();

        if ($show == 0 | empty($pegawai->alamat)) {
            return redirect()->route('pegawai.biodata')->with('warning','Anda belum melengkapi biodata pegawai, Isi biodata anda');
        }
        else {
            return view('pegawai.show', compact('pegawai','show','id'));
        };
    }

    public function biodata()
    {
        $id = Auth::user()->id;
        $jabatan = jabatan::get();
        $pegawai = pegawai::find($id);
        // $jabatan = jabatan::find($id);
        return view('pegawai.edit-pegawai',compact('pegawai','jabatan'));
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
        ]);
        $data = $request->all();
        $data = new pegawai([
            'nama' => $request->get('nama'),
            'email' => $request->get('email'),
            'alamat' => $request->get('alamat'),
            'rekening' => $request->get('rekening'),
            'type_pegawai' => $request->get('type_pegawai'),
            'bank' => $request->get('bank'),
            'jabatan_id' => $request->get('jabatan_id'),
            // 'session_id' => $session_id->get()
            ]);
        $data['id'] = Auth::user()->id;

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
        
        return redirect()->route('pegawai.data')->with('success','Berhasil menambah pegawai');
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
    public function edit($id) //Tambah if else supaya Admin bisa update jabatan user
    {
        // $jabatan = jabatan::select(['id','name'])->get()->keyBy('id');
        // $jabatan = collect([null => 'Tidak ada']+jabatan::select('id','name')->get()->pluck('name','id')->toArray());
        $jabatan = jabatan::select('id','name')->get()->pluck('name','id')->toArray();
        // $jabatan = jabatan::pluck()->keyBy('id')->toArray();
        // [1=>"programmer", 2=>""];
        $pegawai = pegawai::find($id);
        $tunjangan = tunjangan::get();
        $tunjangan_pegawai = DB::table("tunjangan_pegawais")->where("pegawai_id", $id)
                        ->pluck('tunjangan_pegawais.tunjangan_id','tunjangan_pegawais.tunjangan_id')
                        ->all();
        return view('pegawai.edit-pegawai',compact('pegawai','jabatan','tunjangan','tunjangan_pegawai'));
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
            'rekening' => 'required',
            'bank' => 'required',
        ]);

        $pegawai = pegawai::find($id);
        $pegawai->nama = $request->input('nama');
        $pegawai->email = $request->input('email');
        $pegawai->alamat = $request->input('alamat');
        $pegawai->rekening = $request->input('rekening');
        $pegawai->bank = $request->input('bank');
        $pegawai->jabatan_id = $request->input('jabatan_id');
        $pegawai->type_pegawai = $request->input('type_pegawai');
        $pegawai->save();

        $input = $request->all();
        // dd($input);
        if(isset($input['tunjangan_id'])) {
            DB::table('tunjangan_pegawais')->where('pegawai_id',$id)->delete();

            // foreach ($input['tunjangan_id'] as $tunjangan) {
            //     $tunjangans = tunjanganPegawai::create([
            //         'pegawai_id' => $id,
            //         'tunjangan_id' => $tunjangan
            //     ]);
            // }
            
            foreach ($input['tunjangan_id'] as $tunjangan) {
            $input = new tunjanganPegawai([
                'pegawai_id' => $id,
                'tunjangan_id' => $tunjangan
                ]);
            }
            $input->save();
        }

        if (Auth::user()->id != $id) {
            return redirect()->route('pegawai.index')
                        ->with('success','Berhasil update pegawai');
        }else {
            return redirect()->route('pegawai.data')
                        ->with('success','Berhasil update pegawai');
        }
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

