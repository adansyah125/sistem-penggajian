<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $jabatan = [
            'administrasi' => ['Administrasi', 4000000],
            'gudang' => ['Gudang', 3500000],
            'produksi' => ['Produksi', 3500000],
            'keuangan' => ['Keuangan', 4500000],
            'marketing' => ['Marketing', 4000000],
            'hrd' => ['HRD', 4500000],
            'it' => ['IT', 5000000],
            'quality_control' => ['Quality Control', 4000000],
            'operator' => ['Operator', 3000000],
            'supervisor' => ['Supervisor', 5500000],
        ];

        Schema::table('karyawans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jabatan')->nullable()->after('telepon');
            $table->foreign('id_jabatan')->references('id')->on('jabatans')->onDelete('set null');
        });

        foreach ($jabatan as $old => [$nama, $gajiPokok]) {
            $id = DB::table('jabatans')->insertGetId([
                'nama' => $nama,
                'gaji_pokok' => $gajiPokok,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('karyawans')->where('jabatan', $old)->update(['id_jabatan' => $id]);
        }

        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('jabatan')->nullable()->after('telepon');
        });

        DB::table('karyawans')
            ->join('jabatans', 'karyawans.id_jabatan', '=', 'jabatans.id')
            ->update(['karyawans.jabatan' => DB::raw('LOWER(jabatans.nama)')]);

        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropForeign(['id_jabatan']);
            $table->dropColumn('id_jabatan');
        });

        DB::table('jabatans')->truncate();
    }
};
