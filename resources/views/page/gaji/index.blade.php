@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Gaji Karyawan</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div>
                            <a href="{{ route('gaji.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Gaji
                                Karyawan</a>
                            <a href="{{ route('gaji.cetak_all') }}" class="btn btn-danger" target="blank"><i
                                    class="fas fa-print"></i></a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Gaji Pokok</th>
                                            <th>Potongan Pajak</th>
                                            <th>Potongan BPJS</th>
                                            <th>Lembur</th>
                                            <th>Total Gaji (Rp)</th>
                                            <th>Jadwal Pembayaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($gaji as $data)
                                            @php
                                                $potonganPajak = $data->gaji_pokok * $data->persen_pajak / 100;
                                                $potonganBpjs = $data->gaji_pokok * $data->persen_bpjs / 100;
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $data->karyawan->nama }}</td>
                                                <td>{{ $data->karyawan->jabatan->nama ?? '-' }}</td>
                                                <td>Rp. {{ number_format($data->gaji_pokok) }}</td>
                                                <td>
                                                    @if ($data->persen_pajak > 0)
                                                        Rp. {{ number_format($potonganPajak) }}
                                                        ({{ $data->persen_pajak }}%)
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->persen_bpjs > 0)
                                                        Rp. {{ number_format($potonganBpjs) }}
                                                        ({{ $data->persen_bpjs }}%)
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>Rp. {{ number_format($data->lembur) }}</td>
                                                <td>Rp. {{ number_format($data->total_gaji) }}</td>
                                                <td>{{ $data->created_at->translatedformat('d F Y') }}</td>
                                                <td class="d-flex" style="gap: 5px">
                                                    <a href="{{ route('gaji.edit', $data->id) }}" class="btn btn-warning"><i
                                                            class="fas fa-cog"></i></a>
                                                    <a href="{{ route('gaji.delete', $data->id) }}" class="btn btn-danger"
                                                        onclick="return confirm('Yakin Mau Hapus Data Gaji?')"><i
                                                            class="fas fa-trash"></i></a>
                                                    <a href="{{ route('gaji.cetak', $data->id) }}" class="btn btn-success"
                                                        target="blank"><i class="fas fa-print"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
