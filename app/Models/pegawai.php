<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class pegawai extends Model
{
    use HasFactory;

    protected $guarded = [ ];
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'tanggal_masuk',
        'rekening',
        'type_pegawai',
        'bank_id',
        'jabatan_id',
        'bonus_loyalitas',
        'session_id'
    ];

    public function jabatanName($id)
    {
        $jabatan = jabatan::find($id);
        if (!empty($jabatan)) {
            return $jabatan->name;
        };
    }

    public function jabatanBonus($id)
    {
        $jabatan = jabatan::find($id);
        if (!empty($jabatan)) {
            return $jabatan->bonus_profesional;
        };
    }

    public function username($id)
    {
        $username = user::find($id);
        return $username->name;
    }

    // public function jabatanBonus($id)
    // {
    //     $jabatanName = jabatan::find($id);
    //     return $jabatanName->bonus_loyalitas;
    // }

    public function pegawai()
    {
        $this->belongsTo(jabatan::class);
        $this->hasMany(izin::class);
        $this->belongsTo(user::class,'id');
    }
}
