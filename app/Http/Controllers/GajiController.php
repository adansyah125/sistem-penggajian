<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Penggajian::with('karyawan:id,nama')->get();
        return view('page.gaji.index', compact('gaji'));
    }


    public function create()
    {
        $karyawan = Karyawan::all();
        return view('page.gaji.create', compact('karyawan'));
    }
    public function edit($id)
    {
        $karyawan = Karyawan::all();
        $data = Penggajian::findOrFail($id);

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $data,
        // ]);
        return view('page.gaji.edit', compact('data', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'id_karyawan' => 'required',
            'gaji_pokok' => 'required|numeric',
            'lembur' => 'required|numeric',
            'tgl_gaji' => 'required|date',
            'potongan' => 'nullable|numeric',
        ]);

        // Set nilai potongan ke 0 jika null
        $potongan = $validated['potongan'] ?? 0;

        // Hitung total gaji
        $total_gaji = $validated['gaji_pokok'] - $potongan + $validated['lembur'];

        // Update data ke database
        Penggajian::where('id', $id)->update([
            'id_karyawan' => $validated['id_karyawan'],
            'gaji_pokok' => $validated['gaji_pokok'],
            'potongan' => $potongan,
            'lembur' => $validated['lembur'],
            'tgl_gaji' => $validated['tgl_gaji'],
            'total_gaji' => $total_gaji,
        ]);

        return redirect()->route('gaji.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_karyawan' => 'required',
            'gaji_pokok' => 'required',
            'lembur' => 'required',
            'tgl_gaji' => 'required',
            'potongan' => 'required',
        ]);

        // Mengatur nilai potongan menjadi 0 jika null
        $potongan = $validate['potongan'] ?? 0;

        $total_gaji = $validate['gaji_pokok'] - $potongan + $validate['lembur'];

        $data = [
            'id_karyawan' => $request->id_karyawan,
            'gaji_pokok' => $request->gaji_pokok,
            'potongan' => $request->potongan,
            'lembur' => $request->lembur,
            'tgl_gaji' => $request->tgl_gaji,
            'total_gaji' => $total_gaji,
        ];
        Penggajian::create($data);
        Alert::toast('Berhasil Menambah Gaji Karyawan', 'success');
        return redirect()->route('gaji.index');
    }

    public function cetak($id)
    {
        $gaji = Penggajian::with('karyawan')->find($id);

        if (!$gaji) {
            return abort(404, 'Data gaji tidak ditemukan.');
        }

        return view('page.gaji.cetak', compact('gaji'));
    }


    public function cetak_all()
    {
        $data = Penggajian::all();

        if (!$data) {
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
