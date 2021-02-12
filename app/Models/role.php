<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
        'permission'
        ];

    public function userid()
    {
        return $this->belongsToMany(User::class);
    }

    // public function roleuser()
    // {
    // return $this->belongsToMany(role::class)
    // }

}
