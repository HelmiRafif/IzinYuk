<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\gaji;
use App\Models\tunjangan;
use App\Models\potongan;
use DB;

class GajiController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:gaji-list|gaji-create|gaji-edit|gaji-delete', ['only' => ['index','store']]);
        $this->middleware('permission:gaji-create', ['only' => ['create','store']]);
        $this->middleware('permission:gaji-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gaji-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $gaji = gaji::orderBy('id','ASC');
        return view('admin.gaji.index',compact('gaji'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $potongan = potongan::get();
        $tunjangan = tunjangan::get();
        return view('admin.gaji.add-gaji', compact('potongan','tunjangan'));
    }

    public function store(Request $request)
    {
        

        // return redirect()->route('gaji.index')->with('success','Role created successfully');
    }

    public function show($id)
    {
        // $gaji = Role::find($id);
        // $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        //     ->where("role_has_permissions.role_id",$id)
        //     ->get();
    
        // return view('admin.gaji.show',compact('gaji','rolePermissions'));
    }

    public function edit($id)
    {
        // $gaji = Role::find($id);
        // $permission = Permission::get();
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        //     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //     ->all();
    
        // return view('admin.gaji.edit-gaji',compact('gaji','permission','rolePermissions'));
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
