<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji</title>
    <style>
        /* Mengatur agar tabel memiliki layout fixed dan kolom bisa disesuaikan */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Jarak antar struk */
        }

        .struk {
            border: 1px solid #000;
            padding: 10px;
            width: 600px;
            /* Lebar struk */
        }

        .struk td {
            border: none;
            /* Menghilangkan border dalam struk */
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="struk">
            <table>
                <tr align="center">
                    <td colspan="2"><b>Slip Gaji</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-bottom:5px;">
                        <b>PT Cahaya Bulan</b><br>
                        Jl. Bunga No.10, Laweyan, Surakarta
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">Nama : {{ $gaji->karyawan->nama }}</td>
                    <td align="right">Alamat :
                        Jebres, Surakarta
                    </td>
                </tr>
                <tr>
                    <td colspan="1">Jabatan : {{ $gaji->karyawan->jabatan->nama ?? '-' }}</td>
                    
                    <td align="right">Telepon : 0857-8021-8381 </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td align="right"><b>Jumlah</b></td>
                </tr>
                @php
                    $potonganPajak = $gaji->gaji_pokok * $gaji->persen_pajak / 100;
                    $potonganBpjs = $gaji->gaji_pokok * $gaji->persen_bpjs / 100;
                    $totalPotongan = $potonganPajak + $potonganBpjs;
                @endphp
                <tr>
                    <td><b>Gaji Pokok</b></td>
                    <td align="right">Rp. {{ number_format($gaji->gaji_pokok, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><b>Lembur</b> ({{ $gaji->total_jam_lembur }} jam x Rp. {{ number_format($gaji->tarif_lembur) }})</td>
                    <td align="right">Rp. {{ number_format($gaji->lembur, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><b>Total Penghasilan</b> </td>
                    <td align="right"><b>Rp. {{ number_format($gaji->gaji_pokok + $gaji->lembur, 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left"><b>Potongan</b></td>
                </tr>
                <tr>
                    <td><b>Pajak</b> ({{ $gaji->persen_pajak }}%)</td>
                    <td align="right">Rp. {{ number_format($potonganPajak, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><b>BPJS</b> ({{ $gaji->persen_bpjs }}%)</td>
                    <td align="right">Rp. {{ number_format($potonganBpjs, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><b>Total Potongan</b></td>
                    <td align="right"><b>Rp. {{ number_format($totalPotongan, 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    {{-- <td ><b>Terbilang :</b>
                        {{ \App\Support\Terbilang::convert($gaji->total_gaji) }}</td> --}}
                    <td colspan="2" align="right"><b>Total Diterima : Rp.
                            {{ number_format($gaji->total_gaji, 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%">
                            <tr>
                                <td style="border:none">&nbsp;</td>
                                <td style="border:none" align="right">
                                    Jakarta, {{ \Carbon\Carbon::parse($gaji->tgl_gaji)->translatedformat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td style="border:none">Penerima,</td>
                                <td style="border:none" align="right">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="border:none; height:70px">&nbsp;</td>
                                <td style="border:none; height:70px" align="right">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="border:none">({{ $gaji->karyawan->nama }})</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
