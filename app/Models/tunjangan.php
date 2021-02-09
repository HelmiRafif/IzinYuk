<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class tunjangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'besar_tunjangan',
    ];
}
