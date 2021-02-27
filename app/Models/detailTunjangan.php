<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTunjangan extends Model
{
    use HasFactory;

    protected $table = 'detail_tunjangan';

    protected $fillable = ['pegawai_id', 'gaji_id', 'tanggal', 'tunjangan_id', 'besar_tunjangan'];
}
