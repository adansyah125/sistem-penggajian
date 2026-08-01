@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Menambah Data Karyawan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('karyawan.update', $karyawan->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama" value="{{ $karyawan->nama }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $karyawan->email }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Lengkap</label>
                                        <input type="text" name="alamat" value="{{ $karyawan->alamat }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <input type="number" name="telepon" value="{{ $karyawan->telepon }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select id="" name="jabatan" class="form-control">
                                            <option value="">-- Pilih Jabatan --</option>
                                            <option value="administrasi"{{ $karyawan->jabatan === 'administrasi' ? 'selected' : '' }}>
                                                Administrasi
                                            </option>
                                            <option value="gudang"{{ $karyawan->jabatan === 'gudang' ? 'selected' : '' }}>
                                                Gudang
                                            </option>
                                            <option value="produksi"{{ $karyawan->jabatan === 'produksi' ? 'selected' : '' }}>
                                                Produksi
                                            </option>
                                            <option value="keuangan"{{ $karyawan->jabatan === 'keuangan' ? 'selected' : '' }}>
                                                Keuangan
                                            </option>
                                            <option value="marketing"{{ $karyawan->jabatan === 'marketing' ? 'selected' : '' }}>
                                                Marketing
                                            </option>
                                            <option value="hrd"{{ $karyawan->jabatan === 'hrd' ? 'selected' : '' }}>
                                                HRD
                                            </option>
                                            <option value="it"{{ $karyawan->jabatan === 'it' ? 'selected' : '' }}>
                                                IT
                                            </option>
                                            <option value="quality_control"{{ $karyawan->jabatan === 'quality_control' ? 'selected' : '' }}>
                                                Quality Control
                                            </option>
                                            <option value="operator"{{ $karyawan->jabatan === 'operator' ? 'selected' : '' }}>
                                                Operator
                                            </option>
                                            <option value="supervisor"{{ $karyawan->jabatan === 'supervisor' ? 'selected' : '' }}>
                                                Supervisor
                                            </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('karyawan.index') }}" class="btn btn-danger">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
