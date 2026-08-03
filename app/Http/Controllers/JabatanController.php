<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::paginate(10);

        return view('page.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        return view('page.jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jabatans,nama',
            'gaji_pokok' => 'required|numeric|min:0',
            'persen_pajak' => 'nullable|numeric|min:0|max:100',
            'persen_bpjs' => 'nullable|numeric|min:0|max:100',
        ]);

        Jabatan::create([
            'nama' => $request->nama,
            'gaji_pokok' => $request->gaji_pokok,
            'persen_pajak' => $request->persen_pajak ?? 0,
            'persen_bpjs' => $request->persen_bpjs ?? 0,
        ]);

        Alert::toast('Berhasil Menambah Data Jabatan', 'success');

        return redirect()->route('jabatan.index');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('page.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:jabatans,nama,'.$id,
            'gaji_pokok' => 'required|numeric|min:0',
            'persen_pajak' => 'nullable|numeric|min:0|max:100',
            'persen_bpjs' => 'nullable|numeric|min:0|max:100',
        ]);

        Jabatan::findOrFail($id)->update([
            'nama' => $request->nama,
            'gaji_pokok' => $request->gaji_pokok,
            'persen_pajak' => $request->persen_pajak ?? 0,
            'persen_bpjs' => $request->persen_bpjs ?? 0,
        ]);

        Alert::toast('Berhasil Mengubah Data Jabatan', 'success');

        return redirect()->route('jabatan.index');
    }

    public function destroy($id)
    {
        Jabatan::findOrFail($id)->delete();
        Alert::toast('Berhasil Menghapus Data Jabatan', 'success');

        return redirect()->route('jabatan.index');
    }
}
