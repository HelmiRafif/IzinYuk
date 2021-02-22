<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            JabatanTableSeeder::class,
            PotonganTableSeeder::class,
            TunjanganTableSeeder::class,
            PermissionTableSeeder::class,
            UserSeeder::class,
        ]);
    }
}
