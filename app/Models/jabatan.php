<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gaji_pokok',
        'bonus_profesional',
        ];

    protected $hidden = [
        '_token',
    ];
    

    public function jabatan()
    {
        $this->belongsTo(pegawai::class);
    }
}
