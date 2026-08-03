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
        Schema::table('jabatans', function (Blueprint $table) {
            $table->decimal('persen_pajak', 5, 2)->default(5)->after('gaji_pokok');
            $table->decimal('persen_bpjs', 5, 2)->default(2)->after('persen_pajak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {
            $table->dropColumn(['persen_pajak', 'persen_bpjs']);
        });
    }
};
