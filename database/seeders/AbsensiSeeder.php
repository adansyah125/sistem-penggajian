<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Absensi::factory()->count(10)->create();
    }
}
