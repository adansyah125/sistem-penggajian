<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbsensiFactory extends Factory
{
    public function definition(): array
    {
        $karyawanId = Karyawan::inRandomOrder()->first()?->id ?? 1;
        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'id_karyawan' => $karyawanId,
            'status' => $this->faker->randomElement(['hadir', 'izin', 'sakit', 'alpa']),
            'keterangan' => $this->faker->optional(0.3)->sentence(),
        ];
    }
}
