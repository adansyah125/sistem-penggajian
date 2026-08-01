<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penggajian;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->integer('bulan', date('n'));
        $tahun = $request->integer('tahun', date('Y'));

        if ($bulan < 1 || $bulan > 12) {
            $bulan = date('n');
        }
        if ($tahun < 2000) {
            $tahun = date('Y');
        }

        $gaji = Penggajian::with('karyawan:id,nama')
            ->whereMonth('tgl_gaji', $bulan)
            ->whereYear('tgl_gaji', $tahun)
            ->get();

        $totalBersih = $gaji->sum('total_gaji');
        $jumlahKaryawan = $gaji->count();

        $periode = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y');

        $daftarBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $tahunList = Penggajian::selectRaw('YEAR(tgl_gaji) as tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');

        if ($tahunList->isEmpty()) {
            $tahunList = collect([date('Y')]);
        }

        return view('page.laporan.index', compact('gaji', 'totalBersih', 'jumlahKaryawan', 'periode', 'bulan', 'tahun', 'daftarBulan', 'tahunList'));
    }
}
