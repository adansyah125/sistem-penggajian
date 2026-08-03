@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jabatan</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div>
                            <a href="{{ route('jabatan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Jabatan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jabatan</th>
                                            <th>Gaji Pokok</th>
                                            <th>Pajak (%)</th>
                                            <th>BPJS (%)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($jabatan as $data)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>Rp. {{ number_format($data->gaji_pokok) }}</td>
                                                <td>{{ $data->persen_pajak }}%</td>
                                                <td>{{ $data->persen_bpjs }}%</td>
                                                <td>
                                                    <a href="{{ route('jabatan.edit', $data->id) }}"
                                                        class="btn btn-warning"><i class="fas fa-cog"></i></a>
                                                    <a href="{{ route('jabatan.delete', $data->id) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus jabatan ini?')"><i
                                                            class="fas fa-trash"></i></a>
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
