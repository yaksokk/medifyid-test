@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{ url('kategori') }}" class="btn btn-secondary">Kembali ke Daftar Kategori</a>
            </div>
            <div class="card mb-3">
                <div class="card-header">Detail Kategori</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th>Kode</th>
                            <td>:</td>
                            <td>{{ $data->kode }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $data->nama }}</td>
                        </tr>
                    </table>
                    <a class="btn btn-info mt-2" href="{{ url('kategori/form/edit') }}/{{ $data->id }}">Edit</a>
                    <a class="btn btn-danger mt-2" href="{{ url('kategori/delete') }}/{{ $data->id }}" onclick="return confirm('Yakin ingin menghapus kategori ini?');">Delete</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Daftar Item dalam Kategori Ini</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga Beli</th>
                                <th>Laba</th>
                                <th>Harga Jual</th>
                                <th>Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data->masterItems as $item)
                            <tr>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>{{ $item->laba }}%</td>
                                <td>{{ $item->harga_beli + $item->harga_beli * $item->laba / 100 }}</td>
                                <td>{{ $item->supplier }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada item dalam kategori ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
