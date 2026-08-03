<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = [
            ['nama' => 'Administrasi', 'gaji_pokok' => 4000000],
            ['nama' => 'Gudang', 'gaji_pokok' => 3500000],
            ['nama' => 'Produksi', 'gaji_pokok' => 3500000],
            ['nama' => 'Keuangan', 'gaji_pokok' => 4500000],
            ['nama' => 'Marketing', 'gaji_pokok' => 4000000],
            ['nama' => 'HRD', 'gaji_pokok' => 4500000],
            ['nama' => 'IT', 'gaji_pokok' => 5000000],
            ['nama' => 'Quality Control', 'gaji_pokok' => 4000000],
            ['nama' => 'Operator', 'gaji_pokok' => 3000000],
            ['nama' => 'Supervisor', 'gaji_pokok' => 5500000],
        ];

        foreach ($jabatan as $data) {
            DB::table('jabatans')->updateOrInsert(
                ['nama' => $data['nama']],
                array_merge($data, [
                    'persen_pajak' => 5,
                    'persen_bpjs' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ])
            );
        }
    }
}
