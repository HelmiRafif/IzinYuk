<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\jabatan;
use Jabatan as GlobalJabatan;

class JabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatans = [
            'Programmer',
        ];

        foreach ($jabatans as $jabatan) {
            Jabatan::create(['name' => $jabatan, 'gaji_pokok' => '2000000']);
        }
    }
}
