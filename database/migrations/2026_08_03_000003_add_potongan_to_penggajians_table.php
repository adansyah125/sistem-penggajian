<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penggajians', function (Blueprint $table) {
            $table->decimal('persen_pajak', 5, 2)->default(0)->after('potongan');
            $table->decimal('persen_bpjs', 5, 2)->default(0)->after('persen_pajak');
            $table->integer('total_jam_lembur')->default(0)->after('lembur');
            $table->integer('tarif_lembur')->default(15000)->after('total_jam_lembur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penggajians', function (Blueprint $table) {
            $table->dropColumn(['persen_pajak', 'persen_bpjs', 'total_jam_lembur', 'tarif_lembur']);
        });
    }
};
