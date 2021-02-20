<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\pegawai;
use Spatie\Permission\Contracts\Role as RoleContract;
use Illuminate\Support\Arr;
use Hash;
use DB;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id','ASC')->paginate();
        return view('admin.user.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        // $rolesId = Role::pluck('id','name');
        // $roles = Role::findByName(string $name, $guardName = null);
        $roles = Role::query()
        ->select(['name','id'])
        ->get()->toArray();        
        // dd($roles->keyBy('id'));
        return view('admin.user.tambah-user',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $input = new pegawai([
            'nama' => $request->get('name'),
            'email' => $request->get('email'),
            'id' => $user->id
            ]);
        // $input['roles'] = 
            // foreach ($input as $p) {
            //     echo $p->id;
            //     // Role::find($value['id']);
            // }
        
        // $hasrole = $input['roles']->id;
        // $user->user_has_role()->attach($hasrole);
        // dd($hasrole);

        // $userRole = findByName(string $input['roles'], $guardName = null);

        // $roleuser = foreach ($ as $key => $value) {
        //     # code...
        // }
        // $userId = Role::find($input['roles']);
        // $userId->roles()->attach($userId);
        $input->save();

        
        // $user->syncRole($request->input('role_id'));
        
        // $role = role::find($id);
        // $user->roles()->attach($role);

        // $rolesave = role::find($id);
        // $rolesave->roles()->attach($id);

        return redirect()->route('users.index')->with('success','Berhasil menambah user');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.user.edit-user',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->syncRoles($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','Update user berhasil ');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','Berhasil menghapus user');
    }

    // public function useradd()
    // {
    //     $roles = Role::all();
    //     return view("admin.user.tambah-user")->with('roles',$roles);
    // }

}