<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\gaji;
use App\Models\tunjanganPegawai;
use App\Models\pegawai;
use App\Models\tunjangan;
use App\Models\potongan;
use DB;
use Illuminate\Support\Carbon;

class GajiController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:gaji-list|gaji-create', ['only' => ['index','store']]);
        $this->middleware('permission:gaji-create', ['only' => ['create','store']]);
        $this->middleware('permission:gaji-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gaji-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $gaji = gaji::select('gajis.id as id','nama','gaji_pokok','period','bonus_loyalitas','total_tunjangan',
                        DB::raw('gaji_pokok + total_tunjangan + bonus_loyalitas as total_gaji'))
                        ->join('pegawais', 'gajis.pegawai_id', '=', 'pegawais.id')
                        ->get();

        return view('gaji.index');
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $gaji = gaji::select('gajis.id as id','nama','gaji_pokok','period','bonus','total_tunjangan',
                        DB::raw('gaji_pokok + total_tunjangan + bonus as total_gaji'))
                        ->join('pegawais', 'gajis.pegawai_id', '=', 'pegawais.id')
                        ->get();

                    // $gaji->total_gaji = $gaji->gaji_pokok + $gaji->total_tunjangan;
        // $gajiId = gaji::orderBy('id','DESC');
        return view('gaji.add-gaji', compact('gaji'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'period' => 'required'
        ]);

        $now = date('m', strtotime($request->input('period')));
        DB::table('gajis')->whereMonth('period', '=', $now)->delete();

        $gaji = pegawai::select('pegawais.id as pegawai_id','gaji_pokok','bonus_loyalitas',
                    DB::raw('SUM(besar_tunjangan) as total_tunjangan'))
                    ->join('tunjangan_pegawais','pegawais.id', '=', 'tunjangan_pegawais.pegawai_id')
                    ->leftJoin('tunjangans','tunjangan_pegawais.tunjangan_id', '=', 'tunjangans.id')
                    ->join('jabatans','pegawais.jabatan_id', '=', 'jabatans.id')
                    ->groupBy('pegawais.id','gaji_pokok','bonus_loyalitas')
                    ->get()->toArray();

                foreach ($gaji as $input) {
                    $input['period'] = $request->input('period');
                    // dd($input);
                    gaji::create($input);
                }

                    // gaji::create();
                    // dd($gaji);
            return redirect()->route('gaji.create')->with('success','Berhasil generate gaji');



        // return redirect()->route('gaji.index')->with('success','Role created successfully');
    }

    public function show($id)
    {
        
    
        return view('gaji.add-gaji',compact('gaji'));
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'permission' => 'required',
        // ]);
    
        // $gaji = Role::find($id);
        // $gaji->name = $request->input('name');
        // $gaji->save();
        
        // $gaji->syncPermissions($request->input('permission'));

        // return redirect()->route('gaji.index')
        //                 ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        // DB::table("gaji")->where('id',$id)->delete();
        // return redirect()->route('gaji.index')
        //                 ->with('success','Role deleted successfully');
    }
}
