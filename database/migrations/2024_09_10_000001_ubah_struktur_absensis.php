<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('absensis')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn(['minggu_mulai', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu']);
        });

        Schema::table('absensis', function (Blueprint $table) {
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])->default('hadir');
            $table->text('keterangan')->nullable();
            $table->unique(['id_karyawan', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropUnique(['id_karyawan', 'tanggal']);
            $table->dropColumn(['tanggal', 'status', 'keterangan']);
        });

        Schema::table('absensis', function (Blueprint $table) {
            $table->date('minggu_mulai')->nullable();
            $table->boolean('senin')->default(false);
            $table->boolean('selasa')->default(false);
            $table->boolean('rabu')->default(false);
            $table->boolean('kamis')->default(false);
            $table->boolean('jumat')->default(false);
            $table->boolean('sabtu')->default(false);
        });
    }
};
