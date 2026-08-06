<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Penggajian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Penggajian::with('karyawan:id,nama,id_jabatan', 'karyawan.jabatan')->latest()->get();

        return view('page.gaji.index', compact('gaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::with('jabatan')->get();
        $jabatan = Jabatan::all();

        $jabatanByKaryawan = $karyawan->mapWithKeys(function ($k) {
            return [
                $k->id => [
                    'jabatan' => $k->jabatan->nama ?? '-',
                    'gaji_pokok' => $k->jabatan->gaji_pokok ?? 0,
                    'persen_pajak' => $k->jabatan->persen_pajak ?? 0,
                    'persen_bpjs' => $k->jabatan->persen_bpjs ?? 0,
                ],
            ];
        });

        return view('page.gaji.create', compact('karyawan', 'jabatan', 'jabatanByKaryawan'));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::with('jabatan')->get();
        $jabatan = Jabatan::all();
        $data = Penggajian::findOrFail($id);

        $jabatanByKaryawan = $karyawan->mapWithKeys(function ($k) {
            return [
                $k->id => [
                    'jabatan' => $k->jabatan->nama ?? '-',
                    'gaji_pokok' => $k->jabatan->gaji_pokok ?? 0,
                    'persen_pajak' => $k->jabatan->persen_pajak ?? 0,
                    'persen_bpjs' => $k->jabatan->persen_bpjs ?? 0,
                ],
            ];
        });

        return view('page.gaji.edit', compact('data', 'karyawan', 'jabatan', 'jabatanByKaryawan'));
    }

    public function getJamLembur(Request $request)
    {
        $karyawanId = $request->integer('karyawan');
        $bulan = $request->input('bulan');

        if ($karyawanId <= 0 || ! $bulan) {
            return response()->json(['total_jam' => 0]);
        }

        $total = Absensi::where('id_karyawan', $karyawanId)
            ->whereMonth('tanggal', Carbon::parse($bulan)->month)
            ->whereYear('tanggal', Carbon::parse($bulan)->year)
            ->sum('jam_lembur');

        return response()->json(['total_jam' => (int) $total]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_karyawan' => 'required',
            'gaji_pokok' => 'required|numeric|min:0',
            'persen_pajak' => 'nullable|numeric|min:0|max:100',
            'persen_bpjs' => 'nullable|numeric|min:0|max:100',
            'total_jam_lembur' => 'required|numeric|min:0',
            'tarif_lembur' => 'required|numeric|min:0',
            'tgl_gaji' => 'required|date',
        ]);

        $gaji_pokok = $validated['gaji_pokok'];
        $persen_pajak = $validated['persen_pajak'] ?? 0;
        $persen_bpjs = $validated['persen_bpjs'] ?? 0;

        $potongan_pajak = $gaji_pokok * $persen_pajak / 100;
        $potongan_bpjs = $gaji_pokok * $persen_bpjs / 100;
        $potongan = $potongan_pajak + $potongan_bpjs;

        $lembur = $validated['total_jam_lembur'] * $validated['tarif_lembur'];
        $total_gaji = $gaji_pokok + $lembur - $potongan;

        Penggajian::where('id', $id)->update([
            'id_karyawan' => $validated['id_karyawan'],
            'gaji_pokok' => $gaji_pokok,
            'potongan' => round($potongan),
            'persen_pajak' => $persen_pajak,
            'persen_bpjs' => $persen_bpjs,
            'lembur' => $lembur,
            'total_jam_lembur' => $validated['total_jam_lembur'],
            'tarif_lembur' => $validated['tarif_lembur'],
            'tgl_gaji' => $validated['tgl_gaji'],
            'total_gaji' => round($total_gaji),
        ]);

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_karyawan' => 'required',
            'gaji_pokok' => 'required|numeric|min:0',
            'persen_pajak' => 'nullable|numeric|min:0|max:100',
            'persen_bpjs' => 'nullable|numeric|min:0|max:100',
            'total_jam_lembur' => 'required|numeric|min:0',
            'tarif_lembur' => 'required|numeric|min:0',
            'tgl_gaji' => 'required|date',
        ]);

        $gaji_pokok = $validate['gaji_pokok'];
        $persen_pajak = $validate['persen_pajak'] ?? 0;
        $persen_bpjs = $validate['persen_bpjs'] ?? 0;

        $potongan_pajak = $gaji_pokok * $persen_pajak / 100;
        $potongan_bpjs = $gaji_pokok * $persen_bpjs / 100;
        $potongan = $potongan_pajak + $potongan_bpjs;

        $lembur = $validate['total_jam_lembur'] * $validate['tarif_lembur'];
        $total_gaji = $gaji_pokok + $lembur - $potongan;

        $data = [
            'id_karyawan' => $request->id_karyawan,
            'gaji_pokok' => $gaji_pokok,
            'potongan' => round($potongan),
            'persen_pajak' => $persen_pajak,
            'persen_bpjs' => $persen_bpjs,
            'lembur' => $lembur,
            'total_jam_lembur' => $validate['total_jam_lembur'],
            'tarif_lembur' => $validate['tarif_lembur'],
            'tgl_gaji' => $request->tgl_gaji,
            'total_gaji' => round($total_gaji),
        ];
        Penggajian::create($data);
        Alert::toast('Berhasil Menambah Gaji Karyawan', 'success');

        return redirect()->route('gaji.index');
    }

    public function cetak($id)
    {
        $gaji = Penggajian::with('karyawan.jabatan')->find($id);

        if (! $gaji) {
            return abort(404, 'Data gaji tidak ditemukan.');
        }

        return view('page.gaji.cetak', compact('gaji'));
    }

    public function cetak_all()
    {
        $data = Penggajian::with('karyawan.jabatan')->get();

        if (! $data) {
            return abort(404, 'Data gaji tidak ditemukan.');
        }

        return view('page.gaji.cetak_all', compact('data'));
    }

    public function destroy($id)
    {
        Penggajian::findOrFail($id)->delete();
        Alert::toast('Berhasil Menghapus Gaji Karyawan', 'success');

        return redirect()->route('gaji.index');
    }
}
