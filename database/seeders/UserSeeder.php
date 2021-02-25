<?php

namespace Database\Seeders;

use App\Models\jabatan;
use App\Models\pegawai;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'John Pete', 
            'email' => 'johnpete@admin.com',
            'password' => bcrypt('123456')
        ]);
    
        $role = Role::create(['name' => 'Administrator']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $pegawai = pegawai::create([
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'jabatan_id' => 1
        ]);

        // $hasrole = Role::pluck('id','id')->all();
        
    }
}
