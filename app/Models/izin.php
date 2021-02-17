<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pegawai;

class izin extends Model
{
    use HasFactory;

    protected $guarded = [ ];
    protected $fillable =[
        'pegawai_id',
        'type_izin',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];

    public function username($id)
    {
        $username = pegawai::find($id);
        return $username->nama;
    }

    public function izin()
    {
        return $this->belongsTo(pegawai::class);
    }
}
