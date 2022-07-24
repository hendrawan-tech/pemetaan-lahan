@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hasil Panen</h1>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        @php
                            $total = 0;
                            for ($i = 0; $i < count($harvests); $i++) {
                                $total += $harvests[$i]['stok'];
                            }
                        @endphp
                        <h6 class="m-0 font-weight-bold text-primary">Total Panen : {{ $total }}kg</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Jenis Tanaman</th>
                                        <th>Total Panen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plants as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @php
                                                    $totalStok = 0;
                                                    for ($i = 0; $i < count($item->product); $i++) {
                                                        $totalStok += $item->product[$i]['stok'];
                                                    }
                                                @endphp
                                                {{ $totalStok }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Limit Desa</h6>
                    </div>
                    <div class="card-body">
                        <form action="/harvests/limit" method="POST">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Limit</label>
                                        <input type="number" min="0" name="limit"
                                            class="form-control" value="{{ $limit->limit }}">
                                        @error('limit')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
