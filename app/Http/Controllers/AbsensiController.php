<?php

namespace App\Http\Controllers;

use App\Exports\ExportAbsen;
use App\Models\Absensi;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    public function index()
    {
        $records = Absensi::with('karyawan:id,nama')->get();

        $grouped = $records->groupBy(function ($item) {
            $weekStart = Carbon::parse($item->tanggal)->startOfWeek(Carbon::MONDAY)->format('Y-m-d');

            return $weekStart.'-'.$item->id_karyawan;
        });

        $dayMap = [
            'monday' => 'senin', 'tuesday' => 'selasa', 'wednesday' => 'rabu',
            'thursday' => 'kamis', 'friday' => 'jumat', 'saturday' => 'sabtu',
        ];

        $absen = $grouped->map(function ($group) use ($dayMap) {
            $first = $group->first();
            $weekStart = Carbon::parse($first->tanggal)->startOfWeek(Carbon::MONDAY);

            $days = ['senin' => 'alpa', 'selasa' => 'alpa', 'rabu' => 'alpa', 'kamis' => 'alpa', 'jumat' => 'alpa', 'sabtu' => 'alpa'];
            $jam = ['senin' => 0, 'selasa' => 0, 'rabu' => 0, 'kamis' => 0, 'jumat' => 0, 'sabtu' => 0];
            $totalJam = 0;

            foreach ($group as $record) {
                $dayName = strtolower(Carbon::parse($record->tanggal)->locale('en')->dayName);
                if (isset($dayMap[$dayName])) {
                    $days[$dayMap[$dayName]] = $record->status;
                    $jam[$dayMap[$dayName]] = (int) $record->jam_lembur;
                    $totalJam += (int) $record->jam_lembur;
                }
            }

            return (object) [
                'id_karyawan' => $first->id_karyawan,
                'karyawan' => $first->karyawan,
                'minggu_mulai' => $weekStart,
                'senin' => $days['senin'],
                'selasa' => $days['selasa'],
                'rabu' => $days['rabu'],
                'kamis' => $days['kamis'],
                'jumat' => $days['jumat'],
                'sabtu' => $days['sabtu'],
                'jam_senin' => $jam['senin'],
                'jam_selasa' => $jam['selasa'],
                'jam_rabu' => $jam['rabu'],
                'jam_kamis' => $jam['kamis'],
                'jam_jumat' => $jam['jumat'],
                'jam_sabtu' => $jam['sabtu'],
                'total_jam' => $totalJam,
            ];
        })->sortByDesc('minggu_mulai')->values();

        return view('page.absensi.index', compact('absen'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();

        $offset = ['senin' => 0, 'selasa' => 1, 'rabu' => 2, 'kamis' => 3, 'jumat' => 4, 'sabtu' => 5];

        $latest = Absensi::orderBy('tanggal', 'desc')->first();

        if (request()->has('tanggal')) {
            $mingguMulai = Carbon::parse(request('tanggal'))->startOfWeek(Carbon::MONDAY);
        } elseif ($latest) {
            $mingguMulai = Carbon::parse($latest->tanggal)->startOfWeek(Carbon::MONDAY)->addWeek();
        } else {
            $mingguMulai = Carbon::now()->startOfWeek(Carbon::MONDAY);
        }

        $weekEnd = $mingguMulai->copy()->addDays(6);

        $days = [];
        foreach ($offset as $key => $o) {
            $days[$key] = $mingguMulai->copy()->addDays($o)->format('Y-m-d');
        }

        $records = Absensi::whereBetween('tanggal', [$mingguMulai->format('Y-m-d'), $weekEnd->format('Y-m-d')])->get();

        $dayMap = [
            'monday' => 'senin', 'tuesday' => 'selasa', 'wednesday' => 'rabu',
            'thursday' => 'kamis', 'friday' => 'jumat', 'saturday' => 'sabtu',
        ];

        $existing = [];
        foreach ($records as $r) {
            $hariKey = $dayMap[strtolower($r->tanggal->locale('en')->dayName)] ?? null;
            if ($hariKey) {
                $existing[$hariKey][$r->id_karyawan] = $r;
            }
        }

        return view('page.absensi.create', compact('karyawan', 'mingguMulai', 'weekEnd', 'days', 'existing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'minggu_mulai' => 'required|date',
            'status' => 'required|array',
            'status.senin' => 'required|array',
            'status.selasa' => 'required|array',
            'status.rabu' => 'required|array',
            'status.kamis' => 'required|array',
            'status.jumat' => 'required|array',
            'status.sabtu' => 'required|array',
            'status.*.*' => 'required|in:hadir,izin,sakit,alpa',
            'lembur' => 'nullable|array',
            'lembur.*.*' => 'nullable|numeric|min:0',
        ]);

        $offset = ['senin' => 0, 'selasa' => 1, 'rabu' => 2, 'kamis' => 3, 'jumat' => 4, 'sabtu' => 5];

        $mingguMulai = Carbon::parse($request->minggu_mulai);

        if ($mingguMulai->format('N') != 1) {
            return back()->withErrors(['minggu_mulai' => 'Minggu mulai harus hari Senin.'])->withInput();
        }

        foreach ($offset as $hari => $o) {
            $tanggal = $mingguMulai->copy()->addDays($o)->format('Y-m-d');

            foreach ($request->status[$hari] as $idKaryawan => $status) {
                $jam = $request->lembur[$hari][$idKaryawan] ?? 0;
                Absensi::updateOrCreate(
                    ['id_karyawan' => $idKaryawan, 'tanggal' => $tanggal],
                    ['status' => $status, 'jam_lembur' => $jam]
                );
            }
        }

        Alert::toast('Berhasil Menginput Absensi', 'success');

        return redirect()->route('absensi.index');
    }

    public function edit($id)
    {
        $data = Absensi::with('karyawan')->findOrFail($id);

        return view('page.absensi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpa',
            'jam_lembur' => 'nullable|numeric|min:0',
        ]);

        Absensi::findOrFail($id)->update([
            'status' => $request->status,
            'jam_lembur' => $request->jam_lembur ?? 0,
        ]);

        Alert::toast('Berhasil Mengupdate Absensi', 'success');

        return redirect()->route('absensi.index');
    }

    public function destroyWeek($idKaryawan, $mingguMulai)
    {
        $mingguMulai = Carbon::parse($mingguMulai)->startOfWeek(Carbon::MONDAY);
        $endDate = $mingguMulai->copy()->addDays(5);

        Absensi::where('id_karyawan', $idKaryawan)
            ->whereBetween('tanggal', [$mingguMulai->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->delete();

        Alert::toast('Berhasil Menghapus Data Absensi', 'success');

        return redirect()->route('absensi.index');
    }

    public function export_excel()
    {
        return Excel::download(new ExportAbsen, 'absensi.xlsx');
    }

    public function export()
    {
        $absen = Absensi::with('karyawan')->orderBy('tanggal', 'desc')->get();

        return view('page.absensi.export', compact('absen'));
    }

    public function destroy($id)
    {
        Absensi::findOrFail($id)->delete();
        Alert::toast('Berhasil Menghapus Data Absensi', 'success');

        return redirect()->route('absensi.index');
    }
}
