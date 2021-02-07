<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Models\Permission;

class role extends \Spatie\Permission\Models\Role
{
    use HasFactory;
}
