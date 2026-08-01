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
                                <form action="{{ route('karyawan.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Lengkap</label>
                                        <input type="text" name="alamat" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <input type="number" name="telepon" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select id="" name="jabatan" class="form-control">
                                            <option value="">-- Pilih Jabatan --</option>
                                            <option value="administrasi">Administrasi</option>
                                            <option value="gudang">Gudang</option>
                                            <option value="produksi">Produksi</option>
                                            <option value="keuangan">Keuangan</option>
                                            <option value="marketing">Marketing</option>
                                            <option value="hrd">HRD</option>
                                            <option value="it">IT</option>
                                            <option value="quality_control">Quality Control</option>
                                            <option value="operator">Operator</option>
                                            <option value="supervisor">Supervisor</option>
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
