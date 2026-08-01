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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->date('minggu_mulai')->nullable();
            $table->unsignedBigInteger('id_karyawan');              // Tanggal awal minggu
            $table->boolean('senin')->default(false);   // Kehadiran Senin
            $table->boolean('selasa')->default(false);  // Kehadiran Selasa
            $table->boolean('rabu')->default(false);    // Kehadiran Rabu
            $table->boolean('kamis')->default(false);   // Kehadiran Kamis
            $table->boolean('jumat')->default(false);   // Kehadiran Jumat
            $table->boolean('sabtu')->default(false);   // Kehadiran Sabtu
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
