@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Menambah Edit Gaji Karyawan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('gaji.update', $data->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Karyawan</label>
                                        <input type="hidden" name="id_karyawan" value="{{ $data->id_karyawan }}">
                                        <p class="form-control">{{ $data->karyawan->nama }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Gaji Pokok</label>
                                        <input type="number" name="gaji_pokok" class="form-control"
                                            value="{{ $data->gaji_pokok }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Potongan</label>
                                        <input type="number" name="potongan" class="form-control"
                                            value="{{ $data->potongan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Lembur</label>
                                        <input type="number" name="lembur" class="form-control"
                                            value="{{ $data->lembur }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Gaji</label>
                                        <input type="date" name="tgl_gaji" class="form-control"
                                            value="{{ $data->tgl_gaji }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('gaji.index') }}" class="btn btn-danger">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
