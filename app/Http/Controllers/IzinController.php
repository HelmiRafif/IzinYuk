<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\DBAL\Schema\Table;
use App\Models\izin;
use App\Models\pegawai;
use App\Exports\IzinExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Libraries\OpenTBS;
use Maatwebsite\Excel\Facades\Excel;

class IzinController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:izin-list|izin-create|izin-edit|izin-delete', ['only' => ['index','store']]);
        $this->middleware('permission:izin-create', ['only' => ['create','store']]);
        $this->middleware('permission:izin-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:izin-admit', ['only' => ['admit','laporan']]);
        $this->middleware('permission:izin-detail', ['only' => ['detail']]);
        $this->middleware('permission:izin-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        // $izin = Izin::orderBy('id','DESC')->paginate();
        // return view('izin.index',compact('izin'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);

        $izin = izin::select('izins.id','tanggal_mulai','tanggal_selesai','status_diterima','nama','type_izin')
                ->join('pegawais','izins.user_id','=','pegawais.id')
                ->get();
                return view('izin.index',compact('izin'))->with('i');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function detail()
    {
        $id = Auth::user()->id;
        $izin = izin::select()->where('user_id',$id)->get();
        return view('izin.show',compact('izin'));
    }

    public function create(Request $request)
    {
        $id = Auth::user()->id;
        $date = izin::select()->where('user_id',$id)
            ->where('status_diterima','!=','Ditolak')
            ->where('status_diterima','!=','Terlambat')
            ->get();
        // $rejected = izin::where('status_diterima','Ditolak')->count();
        $quota = 6;

        if ($date->count() >= $quota) {
            return redirect()->route('izin.detail')->with('warning','Anda telah mengambil seluruh jatah cuti tahun ini');
        }
        
        
        foreach ($date as $i) {
            $subdays = strtotime($i->tanggal_selesai)>=strtotime('today');
            if ($i->status_diterima == 'Menunggu konfirmasi') {
                return redirect()->route('izin.detail')->with('warning','Anda memiliki izin yang menunggu dikonfirmasi');
            }
            elseif ($subdays == true) {
                return redirect()->route('izin.detail')->with('warning', 'Anda masih menjalani perizinan');
            }
        }
        $izin = izin::get();
        return view('izin.add-izin', compact('izin'));
        // $limit = izin::where($date, Carbon::now()->subDays(30))->get();
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
            'type_izin' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required|after_or_equal:tanggal_mulai',
            'keterangan' => 'required'
        ]);

        $data = new izin([ 
        'type_izin'=> $request->get('type_izin'),
        'tanggal_mulai'=> $request->get('tanggal_mulai'),
        'tanggal_selesai'=> $request->get('tanggal_selesai'),
        'keterangan'=> $request->get('keterangan'),
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['status_diterima'] = 'Menunggu konfirmasi';
        $data->save();

        // $this->validate($request, [
        //     'type_izin' => 'required',
        //     'tanggal_mulai' => 'required',
        //     'tanggal_selesai' => 'required',
        //     'keterangan' => 'required'
        // ]);
        // $pid = Table::select('id')->where('pegawais',$id)->get();
        // izin::create(['type_izin' => $request->input('type_izin'), 'tanggal_mulai' => $request->input('tanggal_mulai'), 'tanggal_selesai' => $request->input('tanggal_selesai'), 'keterangan' => $request->input('keterangan')]);
        
        return redirect()->route('izin.detail')->with('success','Berhasil membuat perizinan');
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
        return view('izin.detail',compact('izin'));
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
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'keterangan' => 'required',
        ]);
        
        $izin = izin::find($id);
        $izin->type_izin = $request->input('type_izin');
        $izin->tanggal_mulai = $request->input('tanggal_mulai');
        $izin->tanggal_selesai = $request->input('tanggal_selesai');
        $izin->keterangan = $request->input('keterangan');
        if (empty($request->input('status_diterima'))) {
            $izin->status_diterima = 'Menunggu konfirmasi';
        }else {
            $izin->status_diterima = $request->input('status_diterima');
        }
        $izin->save();
    
        return redirect()->route('izin.index')
                        ->with('success','Berhasil update izin');
    }

    public function admit(Request $request, $id)
    {
        // $data = DB::table('izins')->select('status_diterima')->get()->toArray();
        $izin = izin::find($id);
        $izin->status_diterima = $request->input('status_diterima');
        $izin->save();
        if ($request->input('status_diterima') == 'Diterima') {
            return redirect()->route('izin.index')
                            ->with('success','Berhasil approve izin');
        }
        elseif ($request->input('status_diterima') == 'Ditolak') {
            return redirect()->route('izin.index')
                            ->with('success','Izin ditolak');
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
        DB::table("izins")->where('id',$id)->delete();

        return redirect()->route('izin.index')
                        ->with('success','Berhasil hapus data izin');
    }

    // 

    public function laporan()
    {
    //  $customer_data = DB::table('tbl_customer')->get()->toArray();
    //  $customer_array[] = array('Customer Name', 'Address', 'City', 'Postal Code', 'Country');
    //  foreach($customer_data as $customer)
    //  {
    //   $customer_array[] = array(
    //    'Customer Name'  => $customer->CustomerName,
    //    'Address'   => $customer->Address,
    //    'City'    => $customer->City,
    //    'Postal Code'  => $customer->PostalCode,
    //    'Country'   => $customer->Country
    //   );
    //  }

    $pegawai = Pegawai::select('pegawais.id','nama')
                -> join('izins','pegawais.id','=','pegawais.id')
                -> groupBy('pegawais.id','nama')
                -> get();

    // $d = [];
    $a = [];
    // $d['date'] = $request->input('id');

    foreach($pegawai as $value) {
        $izin = Izin::where('user_id','=',$value->id)
                    -> where('type_izin','=',"izin")
                    ->count();
        $sakit = Izin::where('user_id','=',$value->id)
                    -> where('type_izin','=',"sakit")
                    ->count();
        $terlambat = Izin::where('user_id','=',$value->id)
                    -> where('type_izin','=',"terlambat")
                    ->count();

        $a[] = [
            'nama' => $value['nama'],  
            'izin' => $izin,
            'sakit' => $sakit,
            'terlambat' => $terlambat,
        ];
    }
    $export = new IzinExport($a);

    return Excel::download($export, 'laporan_Izin.xlsx');
    }

    // public function laporan()
    // {
    //     // $this->validate($request, [
    //     //     'tanggal' => 'required',
    //     // ]);

    //     $pegawai = Pegawai::select('pegawai_id','nama')
    //             -> join('izin','pegawai.id','=','pegawai_id')
    //             -> groupBy('pegawai_id','nama')
    //             -> get();

    //     // $d = [];
    //     $a = [];
    //     // $d['date'] = $request->input('id');

    //     foreach($pegawai as $value) {
    //         $izin = Izin::where('pegawai_id','=',$value->pegawai_id)
    //                     -> where('type_izin','=',"izin")
    //                     ->count();
    //         $sakit = Izin::where('pegawai_id','=',$value->pegawai_id)
    //                     -> where('type_izin','=',"sakit")
    //                     ->count();
    //         $terlambat = Izin::where('pegawai_id','=',$value->pegawai_id)
    //                     -> where('type_izin','=',"terlambat")
    //                     ->count();

    //         $a[] = [
    //             'nama' => $value['nama'],  
    //             'izin' => $izin,
    //             'sakit' => $sakit,
    //             'terlambat' => $terlambat,
    //         ];
    //     }
    //     // dd($a);

    //     $path = asset('laporan/template_izin.xlsx');
    //     $tbs = OpenTBS::loadTemplate($path);
    //     $tbs->mergeBlock('a', $a);
    //     // $tbs->mergeField('d', $d);
    //     $filename = sprintf('Rekap Izin');
    //     $tbs->download("{$filename}.xlsx");
    // }
}