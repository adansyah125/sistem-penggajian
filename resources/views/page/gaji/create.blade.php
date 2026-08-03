@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Menambah Data Gaji Karyawan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('gaji.store') }}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label>Nama Karyawan</label>
                                        <select name="id_karyawan" id="id_karyawan" class="form-control" required>
                                            <option value="">-- Pilih Karyawan --</option>
                                            @foreach ($karyawan as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" id="jabatan" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Gaji Pokok</label>
                                        <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control"
                                            min="0" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Persen Pajak (%)</label>
                                                <input type="number" name="persen_pajak" id="persen_pajak"
                                                    class="form-control" value="0" min="0" max="100" step="0.01"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Persen BPJS (%)</label>
                                                <input type="number" name="persen_bpjs" id="persen_bpjs"
                                                    class="form-control" value="0" min="0" max="100" step="0.01"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Potongan (Total)</label>
                                        <input type="text" id="potongan_display" class="form-control" readonly
                                            placeholder="Rp. 0">
                                    </div>

                                    <hr>
                                    <h6>Lembur</h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Bulan Absensi</label>
                                                <input type="month" name="bulan_absensi" id="bulan_absensi"
                                                    class="form-control" value="{{ date('Y-m') }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Total Jam Lembur</label>
                                                <input type="number" name="total_jam_lembur" id="total_jam_lembur"
                                                    class="form-control" value="0" min="0" readonly>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Tarif Lembur / Jam (Rp)</label>
                                                <input type="number" name="tarif_lembur" id="tarif_lembur"
                                                    class="form-control" value="15000" min="0" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Upah Lembur</label>
                                        <input type="text" id="lembur_display" class="form-control" readonly
                                            placeholder="Rp. 0">
                                    </div>

                                    <div class="form-group">
                                        <label>Jadwal Pembayaran</label>
                                        <input type="date" name="tgl_gaji" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Gaji</label>
                                        <input type="text" id="total_gaji_display" class="form-control" readonly
                                            placeholder="Rp. 0">
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

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jabatanByKaryawan = @json($jabatanByKaryawan);

            const idKaryawan = document.getElementById('id_karyawan');
            const jabatan = document.getElementById('jabatan');
            const gajiPokok = document.getElementById('gaji_pokok');
            const persenPajak = document.getElementById('persen_pajak');
            const persenBpjs = document.getElementById('persen_bpjs');
            const potonganDisplay = document.getElementById('potongan_display');
            const bulanAbsensi = document.getElementById('bulan_absensi');
            const totalJam = document.getElementById('total_jam_lembur');
            const tarifLembur = document.getElementById('tarif_lembur');
            const lemburDisplay = document.getElementById('lembur_display');
            const totalGajiDisplay = document.getElementById('total_gaji_display');

            function rupiah(n) {
                return 'Rp. ' + Number(n || 0).toLocaleString('id-ID');
            }

            function hitung() {
                const pokok = parseFloat(gajiPokok.value) || 0;
                const pajak = parseFloat(persenPajak.value) || 0;
                const bpjs = parseFloat(persenBpjs.value) || 0;
                const jam = parseFloat(totalJam.value) || 0;
                const tarif = parseFloat(tarifLembur.value) || 0;

                const potongan = pokok * (pajak + bpjs) / 100;
                const lembur = jam * tarif;

                potonganDisplay.value = rupiah(potongan);
                lemburDisplay.value = rupiah(lembur);
                totalGajiDisplay.value = rupiah(pokok + lembur - potongan);
            }

            function pilihKaryawan() {
                const info = jabatanByKaryawan[idKaryawan.value];
                if (info) {
                    jabatan.value = info.jabatan;
                    gajiPokok.value = info.gaji_pokok;
                    persenPajak.value = info.persen_pajak;
                    persenBpjs.value = info.persen_bpjs;
                    hitungJamLembur();
                } else {
                    jabatan.value = '';
                    gajiPokok.value = '';
                    persenPajak.value = 0;
                    persenBpjs.value = 0;
                    totalJam.value = 0;
                    hitung();
                }
                hitung();
            }

            function hitungJamLembur() {
                if (!idKaryawan.value || !bulanAbsensi.value) return;
                fetch('{{ route('gaji.jamlembur') }}?karyawan=' + idKaryawan.value + '&bulan=' + bulanAbsensi.value)
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        totalJam.value = data.total_jam || 0;
                        hitung();
                    });
            }

            idKaryawan.addEventListener('change', pilihKaryawan);
            gajiPokok.addEventListener('input', hitung);
            persenPajak.addEventListener('input', hitung);
            persenBpjs.addEventListener('input', hitung);
            totalJam.addEventListener('input', hitung);
            tarifLembur.addEventListener('input', hitung);
            bulanAbsensi.addEventListener('change', hitungJamLembur);

            pilihKaryawan();
            hitungJamLembur();
        });
    </script>
@endsection
