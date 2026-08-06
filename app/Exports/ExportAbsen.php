<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAbsen implements FromView
{
    public function __construct(public string $bulan)
    {
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $bulan = \Carbon\Carbon::parse($this->bulan . '-01');
        $absen = Absensi::whereYear('tanggal', (int) substr($this->bulan, 0, 4))
            ->whereMonth('tanggal', (int) substr($this->bulan, 5, 2))
            ->with('karyawan')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('page.absensi.export', compact('absen', 'bulan'));
    }
}
