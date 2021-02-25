<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    use HasFactory;

    protected $fillable = ['pegawai_id','gaji_pokok','total_tunjangan','bonus','period'];
}
