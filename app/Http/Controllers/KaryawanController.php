<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::with('jabatan')->paginate(10);

        return view('page.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $jabatan = Jabatan::all();

        return view('page.karyawan.create', compact('jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'id_jabatan' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'id_jabatan' => $request->id_jabatan,
        ];
        Karyawan::create($data);
        Alert::toast('Berhasil Menambah Data Karyawan', 'success');

        return redirect()->route('karyawan.index');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jabatan = Jabatan::all();

        return view('page.karyawan.edit', compact('karyawan', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'id_jabatan' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'id_jabatan' => $request->id_jabatan,
        ];
        Karyawan::findOrFail($id)->update($data);
        Alert::toast('Berhasil Mengubah Data Karyawan', 'success');

        return redirect()->route('karyawan.index');
    }

    public function destroy($id)
    {
        Karyawan::findOrfail($id)->delete();
        Alert::toast('Berhasil Menghapus Data Karyawan', 'success');

        return redirect()->route('karyawan.index');
    }
}
