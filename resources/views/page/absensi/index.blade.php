@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Absensi Karyawan</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div>
                            <a href="{{ route('absensi.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Input Absensi</a>
                            <a href="absensi-export" class="btn btn-success"><i class="fas fa-download"></i>
                                Excel</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Tanggal</th>
                                            <th>Senin</th>
                                            <th>Selasa</th>
                                            <th>Rabu</th>
                                            <th>Kamis</th>
                                            <th>Jumat</th>
                                            <th>Sabtu</th>
                                            <th>Minggu</th>
                                            <th>Jam Lembur</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($absen as $data)
                                            <tr>
                                                <th>{{ $loop->index + 1 }}</th>
                                                <th>{{ $data->karyawan->nama }}</th>
                                                <td>
                                                    {{ $data->minggu_mulai->translatedFormat('d F Y') }} -
                                                    {{ $data->minggu_mulai->copy()->addDays(6)->translatedFormat('d F Y') }}
                                                </td>
                                                <td>
                                                    @php $b = $data->senin == 'hadir' ? 'badge-success' : ($data->senin == 'izin' ? 'badge-primary' : ($data->senin == 'sakit' ? 'badge-warning' : 'badge-danger')); @endphp
                                                    <span class="badge {{ $b }}">{{ ucfirst($data->senin) }}</span>
                                                </td>
                                                <td>
                                                    @php $b = $data->selasa == 'hadir' ? 'badge-success' : ($data->selasa == 'izin' ? 'badge-primary' : ($data->selasa == 'sakit' ? 'badge-warning' : 'badge-danger')); @endphp
                                                    <span class="badge {{ $b }}">{{ ucfirst($data->selasa) }}</span>
                                                </td>
                                                <td>
                                                    @php $b = $data->rabu == 'hadir' ? 'badge-success' : ($data->rabu == 'izin' ? 'badge-primary' : ($data->rabu == 'sakit' ? 'badge-warning' : 'badge-danger')); @endphp
                                                    <span class="badge {{ $b }}">{{ ucfirst($data->rabu) }}</span>
                                                </td>
                                                <td>
                                                    @php $b = $data->kamis == 'hadir' ? 'badge-success' : ($data->kamis == 'izin' ? 'badge-primary' : ($data->kamis == 'sakit' ? 'badge-warning' : 'badge-danger')); @endphp
                                                    <span class="badge {{ $b }}">{{ ucfirst($data->kamis) }}</span>
                                                </td>
                                                <td>
                                                    @php $b = $data->jumat == 'hadir' ? 'badge-success' : ($data->jumat == 'izin' ? 'badge-primary' : ($data->jumat == 'sakit' ? 'badge-warning' : 'badge-danger')); @endphp
                                                    <span class="badge {{ $b }}">{{ ucfirst($data->jumat) }}</span>
                                                </td>
                                                <td>
                                                    @php $b = $data->sabtu == 'hadir' ? 'badge-success' : ($data->sabtu == 'izin' ? 'badge-primary' : ($data->sabtu == 'sakit' ? 'badge-warning' : 'badge-danger')); @endphp
                                                    <span class="badge {{ $b }}">{{ ucfirst($data->sabtu) }}</span>
                                                </td>
                                                <td><span class="badge badge-secondary">Libur</span></td>
                                                <td>
                                                    @if ($data->total_jam > 0)
                                                        <span class="badge badge-info">{{ $data->total_jam }} jam</span>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="d-flex" style="gap:5px">
                                                    <a href="{{ route('absensi.create', ['tanggal' => $data->minggu_mulai->format('Y-m-d')]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('absensi.delete.week', [$data->id_karyawan, $data->minggu_mulai->format('Y-m-d')]) }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus absensi minggu ini?')"><i class="fas fa-trash"></i></a>
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
