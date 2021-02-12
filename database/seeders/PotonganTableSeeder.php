<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\potongan;

class PotonganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $potongans = [
            'Terlambat',
        ];

        foreach ($potongans as $potongan) {
            potongan::create(['name' => $potongan, 'besar_potongan' => '20000']);
        }
    }
}
