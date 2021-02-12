<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Contracts\Role as RoleContract;
use Illuminate\Http\Request;
use App\Models\role;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function roleid()
    // {
    //     return $this->hasMany(role::class);
    //     User::find($input['roles']);
    // }

    // public static function findByName(string $name, $guardName = null):RoleContract
    // {
    //     # code...
    // }

    // public function hasrole(Request $request, $id)
    // {        
    //     $roleid = role::find($id);
    //     foreach ($roleid as $key => $i) {
    //         $roleid->syncRoles($request->input($i));
    //     }


    // }

    // $user = App\Models\User::first();

    // foreach ($user->roles as $role) {
    //     echo $role->name;
}
