@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Input Absensi</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('absensi.store') }}" method="post">
                                @csrf
                                @php
                                    $offset = ['senin' => 0, 'selasa' => 1, 'rabu' => 2, 'kamis' => 3, 'jumat' => 4, 'sabtu' => 5];
                                    $statuses = ['hadir', 'izin', 'sakit', 'alpa'];
                                @endphp
                                <div class="form-group">
                                    <label>Tanggal (Minggu Mulai)</label>
                                    <input type="date" name="minggu_mulai"
                                        class="form-control @error('minggu_mulai') is-invalid @enderror"
                                        value="{{ old('minggu_mulai', $mingguMulai->format('Y-m-d')) }}" required>
                                    @error('minggu_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="alert alert-info" id="week-range">
                                        Minggu: {{ $mingguMulai->translatedFormat('d F Y') }} -
                                        {{ $weekEnd->translatedFormat('d F Y') }} (Minggu libur)
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Karyawan</th>
                                                @foreach ($offset as $key => $o)
                                                    <th data-day="{{ $key }}">
                                                        {{ \Carbon\Carbon::parse($days[$key])->translatedFormat('l d F') }}</th>
                                                @endforeach
                                                <th>Minggu (Libur)</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($karyawan as $k)
                                                @php $ket = $existing['senin'][$k->id]->keterangan ?? ''; @endphp
                                                <tr>
                                                    <th>{{ $loop->index + 1 }}</th>
                                                    <th class="text-left">{{ $k->nama }}</th>
                                                    @foreach ($offset as $key => $o)
                                                        @php
                                                            $st = isset($existing[$key][$k->id]) ? $existing[$key][$k->id]->status : 'hadir';
                                                        @endphp
                                                        <td>
                                                            <select name="status[{{ $key }}][{{ $k->id }}]"
                                                                class="form-control">
                                                                @foreach ($statuses as $s)
                                                                    <option value="{{ $s }}" {{ $st == $s ? 'selected' : '' }}>
                                                                        {{ ucfirst($s) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    @endforeach
                                                    <td><span class="badge badge-secondary">Libur</span></td>
                                                    <td>
                                                        <input type="text" name="keterangan[{{ $k->id }}]"
                                                            class="form-control"
                                                            value="{{ old('keterangan.' . $k->id, $ket) }}"
                                                            placeholder="Opsional">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.querySelector('input[name="minggu_mulai"]');
            var range = document.getElementById('week-range');
            var dayCells = document.querySelectorAll('th[data-day]');
            if (!input) return;

            var monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var hariKeys = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];

            function fmt(d) {
                return d.getDate() + ' ' + monthNames[d.getMonth()] + ' ' + d.getFullYear();
            }

            function update() {
                if (!input.value) return;
                var start = new Date(input.value + 'T00:00:00');
                var end = new Date(start);
                end.setDate(end.getDate() + 6);

                if (range) {
                    range.textContent = 'Minggu: ' + fmt(start) + ' - ' + fmt(end) + ' (Minggu libur)';
                }

                if (dayCells.length) {
                    dayCells.forEach(function(cell) {
                        var key = cell.getAttribute('data-day');
                        var i = hariKeys.indexOf(key);
                        var d = new Date(start);
                        d.setDate(d.getDate() + i);
                        cell.textContent = dayNames[i + 1] + ' ' + d.getDate() + ' ' + monthNames[d.getMonth()];
                    });
                }
            }

            input.addEventListener('change', update);
            update();
        });
    </script>
@endsection
