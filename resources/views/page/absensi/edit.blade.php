@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Absensi</h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('absensi.update', $data->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Karyawan</label>
                                    <input type="text" class="form-control" value="{{ $data->karyawan->nama }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="hadir" {{ $data->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="izin" {{ $data->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="sakit" {{ $data->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="alpa" {{ $data->status == 'alpa' ? 'selected' : '' }}>Alpa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Opsional">{{ $data->keterangan }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('absensi.index') }}" class="btn btn-danger">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
