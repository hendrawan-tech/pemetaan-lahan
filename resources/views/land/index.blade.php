@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lahan</h1>
            <a href="/lands/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Lahan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Tanaman</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lands as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->plantType->name }}</td>
                                    <td class="d-flex align-items-center justify-content-between">
                                        {{ $item->status }} @if ($item->status == 'Proses Tanam')
                                            <a href="/harvest/{{ $item->id }}" class="btn btn-primary btn-sm">Panen
                                                Sekarang</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="/lands/{{ $item->id }}/edit"
                                            class="btn btn-sm btn-primary btn-circle mr-2">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        {{-- <a href="#" class="btn btn-sm btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
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
