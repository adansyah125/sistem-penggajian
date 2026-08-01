<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'jabatan' => $this->faker->randomElement(['administrasi', 'gudang', 'produksi', 'keuangan', 'marketing', 'hrd', 'it', 'quality_control', 'operator', 'supervisor']),
        ];
    }
}
