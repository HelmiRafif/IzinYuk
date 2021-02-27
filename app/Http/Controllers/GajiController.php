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
use App\Libraries\OpenTBS;
use Illuminate\Support\Facades\Auth;
use App\Models\detailTunjangan;

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
        $pegawai_id = Auth::user()->id;
        $gaji = gaji::select('gajis.id as id','nama','gaji_pokok','period','gajis.bonus_loyalitas','total_tunjangan',
                        DB::raw('gaji_pokok + total_tunjangan + gajis.bonus_loyalitas as total_gaji'))
                        ->join('pegawais', 'gajis.pegawai_id', '=', 'pegawais.id')
                        ->where('pegawai_id', '=', $pegawai_id)
                        ->orderBy('period','desc')
                        ->first();

                if (isset($gaji->id)) {
                    $tunjangan = tunjangan::select('name', 'detail_tunjangan.besar_tunjangan')
                    ->join('detail_tunjangan', 'tunjangans.id', '=', 'tunjangan_id')
                    ->where('gaji_id', '=', $gaji->id)
                    ->get();
                }

                if (empty($gaji)) {
                    return view('gaji.index');
                }else {
                    return view('gaji.index', compact('gaji','tunjangan'));
                }

        // return view('gaji.index');
        //     ->with('i', ($request->input('page', 1) - 1) * 5);e
    }

    public function create()
    {
        $gaji = gaji::select('gajis.id as id','nama','gaji_pokok','period','gajis.bonus_loyalitas','total_tunjangan',
                        DB::raw('gaji_pokok + total_tunjangan + gajis.bonus_loyalitas as total_gaji'))
                        ->join('pegawais', 'gajis.pegawai_id', '=', 'pegawais.id')
                        ->orderBy('period','DESC')
                        ->get();

                        // dd($gaji);

                    // $gaji->total_gaji = $gaji->gaji_pokok + $gaji->total_tunjangan;
        // $gajiId = gaji::orderBy('id','DESC');
        return view('gaji.add-gaji', compact('gaji'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'period' => 'required'
        ]);

        $gaji =gaji::get();
        $now = date('m', strtotime($request->input('period')));
        DB::table('gajis')->whereMonth('period', '=', $now)->delete();

        $gaji = pegawai::select('pegawais.id as pegawai_id','gaji_pokok','bonus_profesional', 'tanggal_masuk',
                    DB::raw('SUM(besar_tunjangan) as total_tunjangan'))
                    ->join('tunjangan_pegawais','pegawais.id', '=', 'tunjangan_pegawais.pegawai_id')
                    ->leftJoin('tunjangans','tunjangan_pegawais.tunjangan_id', '=', 'tunjangans.id')
                    ->join('jabatans','pegawais.jabatan_id', '=', 'jabatans.id')
                    ->groupBy('pegawais.id','gaji_pokok','bonus_profesional','tanggal_masuk')
                    ->get()->toArray();

                    // dd($gaji);

                foreach ($gaji as $input) {
                    $input['period'] = $request->input('period');
                    // dd($input);
                    
                    $interval = abs(strtotime(Carbon::today()) - strtotime($input['tanggal_masuk']));
                    $masa_kerja = floor($interval / (365*60*60*24));
                    // dd($masa_kerja);
                    $input['bonus_loyalitas'] = $masa_kerja * $input['bonus_profesional'];
                    // dd($input['bonus_loyalitas']);
                    // dd($input);
                    $generate = gaji::create($input);
                    $pegawai = pegawai::where('id', '=', $input['pegawai_id'])->first();
                    $pegawai->bonus_loyalitas = $input['bonus_loyalitas'];
                    $pegawai->save();

                    $tunjangan = tunjangan::select('tunjangan_id','besar_tunjangan','pegawai_id')
                                    ->join('tunjangan_pegawais','tunjangans.id','=','tunjangan_id')
                                    ->where('pegawai_id', '=', $generate->pegawai_id)
                                    ->get();


                    foreach ($tunjangan as $detail) {
                        // dd($detail);
                        // detailTunjangan::create([
                        //     'gaji_id' => $generate->id,
                        //     'pegawai_id' => $detail->pegawai_id,
                        //     'tanggal' => $generate->period,
                        //     'tunjangan_id' => $detail->tunjangan_id,
                        //     'besar_tunjangan' => $detail->besar_tunjangan
                        // ]);
                        // dd(gettype($detail->besar_tunjangan));
                        $detailTunjangan = new detailTunjangan([
                            'gaji_id' => $generate->id,
                            'pegawai_id' => $detail->pegawai_id,
                            'tanggal' => $generate->period,
                            'tunjangan_id' => $detail->tunjangan_id,
                            'besar_tunjangan' => $detail->besar_tunjangan
                        ]);
                        // dd($detailTunjangan);
                        $detailTunjangan->save();
                    }
                }

                    // gaji::create();
                    // dd($gaji);
            return redirect()->route('gaji.create')->with('success','Berhasil generate gaji');



        // return redirect()->route('gaji.index')->with('success','Role created successfully');
    }

    public function show()
    {
        $pegawai_id = Auth::user()->id;
        $gaji = gaji::select('gajis.id as id','nama','gaji_pokok','period','gajis.bonus_loyalitas','total_tunjangan',
                        DB::raw('gaji_pokok + total_tunjangan + gajis.bonus_loyalitas as total_gaji'))
                        ->join('pegawais', 'gajis.pegawai_id', '=', 'pegawais.id')
                        ->where('pegawai_id', '=', $pegawai_id)
                        ->orderBy('period','desc')
                        ->first();

                if (isset($gaji->id)) {
                    $tunjangan = tunjangan::select('name', 'detail_tunjangan.besar_tunjangan')
                    ->join('detail_tunjangan', 'tunjangans.id', '=', 'tunjangan_id')
                    ->where('gaji_id', '=', $gaji->id)
                    ->get();
                }

                if (empty($gaji)) {
                    return view('gaji.show');
                }else {
                    return view('gaji.show', compact('gaji','tunjangan'));
                }
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
