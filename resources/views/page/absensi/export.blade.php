<h1>Data Absensi Karyawan</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Karyawan</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absen as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</td>
                <td>{{ $data->karyawan->nama }}</td>
                <td>{{ ucfirst($data->status) }}</td>
                <td>{{ $data->keterangan ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
