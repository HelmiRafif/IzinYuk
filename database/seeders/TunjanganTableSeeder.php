<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\tunjangan;

class TunjanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tunjangans = [
            'Transport',
        ];

        foreach ($tunjangans as $tunjangan) {
            Tunjangan::create(['name' => $tunjangan, 'besar_tunjangan' => '300000']);
        }
    }
}
