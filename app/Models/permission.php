<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;

class permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory, HasPermissions;
}
