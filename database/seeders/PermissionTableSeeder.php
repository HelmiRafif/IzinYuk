<?php

namespace Database\Seeders;

use App\Http\Controllers\PermissionController;
use App\Models\role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',            //1
            'role-create',          //2
            'role-edit',            //3
            'role-delete',          //4
            'permission-list',      //5
            'permission-create',    //6
            'permission-edit',      //7
            'permission-delete',    //8
            'user-list',            //9
            'user-create',          //10
            'user-edit',            //11            
            'user-delete',          //12          
            'jabatan-list',         //13             
            'jabatan-create',       //14           
            'jabatan-edit',         //15             
            'jabatan-delete',       //16           
            'tunjangan-list',       //17           
            'tunjangan-create',     //18             
            'tunjangan-edit',       //19
            'tunjangan-delete',     //20
            'potongan-list',        //21
            'potongan-create',      //22
            'potongan-edit',        //23
            'potongan-delete',      //24
            'pegawai-list',         //25
            'pegawai-create',       //26
            'pegawai-edit',         //27
            'pegawai-delete',       //28
            'pegawai-biodata',      //29
            'izin-list',            //30
            'izin-create',          //31
            'izin-edit',            //32
            'izin-delete',          //33
            'izin-admit',           //34
            'izin-detail'           //35
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = role::create(['name' => 'Production']);
        $role->GivePermissionTo(17,21,29,31,32,35);

        $role = role::create(['name' => 'Sales']);
        $role->GivePermissionTo(17,21,29,31,32,35);
    }
}
