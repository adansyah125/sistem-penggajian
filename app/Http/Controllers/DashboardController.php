<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = User::all();
        $karyawan = Karyawan::count();
        $absensi = Absensi::whereYear('tanggal', date('Y'))->whereMonth('tanggal', date('m'))->count();
        $gaji = Penggajian::with('karyawan')->get();
        $totalGajiPokok = $gaji->sum('gaji_pokok');
        $totalPotongan = $gaji->sum('potongan');
        $totalLembur = $gaji->sum('lembur');
        $total = $totalGajiPokok - $totalPotongan + $totalLembur;

        $monthlyGaji = Penggajian::select(
            DB::raw('MONTH(tgl_gaji) as bulan'),
            DB::raw('SUM(total_gaji) as total')
        )
            ->whereYear('tgl_gaji', date('Y'))
            ->groupBy(DB::raw('MONTH(tgl_gaji)'))
            ->orderBy(DB::raw('MONTH(tgl_gaji)'))
            ->pluck('total', 'bulan');

        $gajiPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $gajiPerBulan[] = $monthlyGaji[$i] ?? 0;
        }

        return view('page.dashboard', compact('karyawan', 'total', 'absensi', 'profile', 'gajiPerBulan'));
    }
}
