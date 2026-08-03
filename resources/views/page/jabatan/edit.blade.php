@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Jabatan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('jabatan.update', $jabatan->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Jabatan</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $jabatan->nama }}" placeholder="Contoh: Manajer">
                                    </div>
                                    <div class="form-group">
                                        <label>Gaji Pokok</label>
                                        <input type="number" name="gaji_pokok" class="form-control"
                                            value="{{ $jabatan->gaji_pokok }}" min="0">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Persen Pajak (%)</label>
                                                <input type="number" name="persen_pajak" class="form-control"
                                                    value="{{ $jabatan->persen_pajak }}" min="0" max="100" step="0.01">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Persen BPJS (%)</label>
                                                <input type="number" name="persen_bpjs" class="form-control"
                                                    value="{{ $jabatan->persen_bpjs }}" min="0" max="100" step="0.01">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('jabatan.index') }}" class="btn btn-danger">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
