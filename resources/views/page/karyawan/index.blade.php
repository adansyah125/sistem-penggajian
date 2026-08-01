@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Karyawan</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div>
                            <a href="{{ route('karyawan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Karyawan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Jabatan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($karyawan as $data)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->alamat }}</td>
                                                <td>{{ $data->telepon }}</td>
                                                <td>
                                                    <div class="badge badge-success">{{ $data->jabatan }}</div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('karyawan.edit', $data->id) }}"
                                                        class="btn btn-warning"><i class="fas fa-cog"></i></a>
                                                    <a href="{{ route('karyawan.delete', $data->id) }}"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
