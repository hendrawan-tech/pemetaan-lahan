@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hasil Panen</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                @php
                    $total = 0;
                    for ($i = 0; $i < count($harvests); $i++) {
                        $total += $harvests[$i]['stok'];
                    }
                @endphp
                <h6 class="m-0 font-weight-bold text-primary">Total Panen : {{ $total }}kg - Limit :
                    {{ $limit->limit }} = {{ $total - $limit->limit }}kg
                </h6>
                <div>
                    <a href="/harvests/limit" class="btn btn-primary btn-sm">Limit Desa</a>
                    <a href="/harvests/reset" class="btn btn-danger btn-sm">Reset Pertanian</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Petani</th>
                                <th>Lahan</th>
                                <th>Jenis Tanaman</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($harvests as $item)
                                <tr>
                                    <td>
                                        <div style="width: 100px; height: 50px;">
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ Helper::price($item->price) }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->land->user->name }}</td>
                                    <td>{{ $item->land->name }}</td>
                                    <td>{{ $item->plantType->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td class="text-center">
                                        @if ($item->status == 'Proses')
                                            <a href="/harvests/{{ $item->id }}" class="btn btn-primary btn-sm">Acc
                                                Penjualan</a>
                                        @else
                                            Tidak ada opsi
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
