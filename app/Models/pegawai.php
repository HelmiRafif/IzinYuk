<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'tanggal_masuk',
        'rekening',
        'type_pegawai',
        'bank_id',
        'jabatan_id',
        'bonus_loyalitas'
    ];

    public function jabatanName($id)
    {
        $jabatanName = jabatan::find($id);
        return $jabatanName->name;
    }

    // public function jabatanBonus($id)
    // {
    //     $jabatanName = jabatan::find($id);
    //     return $jabatanName->bonus_loyalitas;
    // }

    public function pegawai()
    {
        $this->belongsTo(jabatan::class);
    }
}
