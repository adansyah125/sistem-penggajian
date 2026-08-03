@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Karyawan</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('laporan') }}" class="mb-3 d-flex align-items-center" style="gap: 10px">
                                <div>
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-control">
                                        @foreach ($daftarBulan as $key => $nama)
                                            <option value="{{ $key }}" @selected($key == $bulan)>{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        @foreach ($tahunList as $tahunItem)
                                            <option value="{{ $tahunItem }}" @selected($tahunItem == $tahun)>{{ $tahunItem }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin-top: 25px">
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Total Gaji (Rp)</th>
                                            <th>Jadwal Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($gaji as $data)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $data->karyawan->nama }}</td>
                                                <td>Rp. {{ number_format($data->total_gaji, 0, ',', '.') }}</td>
                                                <td>{{ $data->tgl_gaji ? \Carbon\Carbon::parse($data->tgl_gaji)->translatedformat('d F Y') : $data->created_at->translatedformat('d F Y') }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                <h6>Ringkasan Arus Kas Keluar (Periode {{ $periode }})</h6>
                                <table class="table table-bordered" style="max-width: 500px">
                                    <tr>
                                        <td>Total Gaji Bersih Karyawan</td>
                                        <td class="text-end">Rp. {{ number_format($totalBersih, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Karyawan</td>
                                        <td class="text-end">{{ $jumlahKaryawan }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
