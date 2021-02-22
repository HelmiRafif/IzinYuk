<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\permission;
use App\Models\role;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use DB;


class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::get();
        // $permissions = Permission::orderBy('id','ASC')->paginate();
        return view('admin.permission.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);  
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
        $permission = permission::get();
        return view('admin.permission.add-permission', compact('permission'));
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
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required',
        ]);
        
        // $permission = $request->input('permission');
        // $permission->syncRoles();
        Permission::create(['name' => $request->input('name'), 'guard_name' => $request->input('guard_name')]);
        
        return redirect()->route('permissions.index')->with('success','Permission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = permission::find($id);
        return view('admin.permission.edit-permission',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        request()->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);
    
        $permission->update($request->all());
    
        return redirect()->route('permissions.index')
                        ->with('success','Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        $permission->delete();
    
        return redirect()->route('permission.index')
                        ->with('success','Permission deleted successfully');
    }
}
