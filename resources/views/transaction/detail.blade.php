@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="page-content container">
                    <div class="page-header text-blue-d2">
                        <h1 class="page-title text-secondary-d1">
                            Tagihan Pembayaran
                            <small class="page-info">
                                <i class="fa fa-angle-double-right text-80"></i>
                                #{{ $transaction['code'] }}
                            </small>
                        </h1>
                    </div>

                    <div class="px-0">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-12">
                                <hr class="row brc-default-l1 mx-n1 mb-4" />
                                <div class="row">
                                    <div class="col-sm-6">
                                        @if (Auth::user()->role == 'Tengkulak')
                                            <div>
                                                <span class="text-sm text-grey-m2 align-middle">Petani:</span>
                                                <span
                                                    class="text-600 text-110 text-blue align-middle">{{ $transaction->payment->user->name }}</span>
                                            </div>
                                            <div class="text-grey-m2">
                                                <div class="my-1">
                                                    No HP : {{ $transaction->payment->user->phone }}
                                                </div>
                                                <div class="my-1">
                                                    Alamat : {{ $transaction->payment->user->address }}
                                                </div>
                                            </div>
                                        @else
                                            <div>
                                                <span class="text-sm text-grey-m2 align-middle">Tengkulak:</span>
                                                <span
                                                    class="text-600 text-110 text-blue align-middle">{{ $transaction->user->name }}</span>
                                            </div>
                                            <div class="text-grey-m2">
                                                <div class="my-1">
                                                    No HP : {{ $transaction->user->phone }}
                                                </div>
                                                <div class="my-1">
                                                    Alamat : {{ $transaction->user->address }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                        <hr class="d-sm-none" />
                                        <div class="text-grey-m2">
                                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                                Tagihan Pembayaran
                                            </div>

                                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                    class="text-600 text-90">No. Transaksi:</span> #{{ $transaction->code }}
                                            </div>

                                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                    class="text-600 text-90">Tanggal:</span> {{ $transaction->created_at }}
                                            </div>

                                            <div class="my-2">
                                                <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                                <span class="text-600 text-90">Status:</span>
                                                @if ($transaction->status == 'Menunggu Pembayaran')
                                                    <span class="badge badge-warning badge-pill px-25">
                                                        {{ $transaction->status }}</span>
                                                @elseif($transaction->status == 'Proses')
                                                    <span class="badge badge-info badge-pill px-25">
                                                        {{ $transaction->status }}</span>
                                                @elseif($transaction->status == 'Selesai')
                                                    <span class="badge badge-success badge-pill px-25">
                                                        {{ $transaction->status }}</span>
                                                @else
                                                    <span class="badge badge-danger badge-pill px-25">
                                                        {{ $transaction->status }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-striped table-bordered border-0 border-b-2 brc-default-l1">
                                            <thead class="bg-none bgc-default-tp1">
                                                <tr class="text-white">
                                                    <th class="opacity-2">#</th>
                                                    <th>Produk</th>
                                                    <th>Kuantitas</th>
                                                    <th>Harga/Kilo</th>
                                                    <th width="140">Subtotal</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-95 text-secondary-d3">
                                                @foreach ($transaction->item as $key => $data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $data->product->name }}</td>
                                                        <td>{{ $data->quantity }}</td>
                                                        <td class="text-95">{{ Helper::price($data->product->price) }}</td>
                                                        <td class="text-secondary-d2">
                                                            {{ Helper::price($data->product->price * $data->quantity) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex bg-light justify-content-end">
                                        <div class="d-flex align-items-center bgc-primary-l3 p-2">
                                            <div class="text-right mr-3">
                                                Total Harga
                                            </div>
                                            <div class="">
                                                <b
                                                    class="text-150 text-lg text-success-d3 opacity-2">{{ Helper::price($transaction->total) }}</b>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="table-responsive">
                                        <table
                                            class="table table-striped table-bordered border-0 border-b-2 brc-default-l1">
                                            <thead class="bg-none bgc-default-tp1">
                                                <tr class="text-white">
                                                    <th class="opacity-2">#</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-95 text-secondary-d3">
                                                @foreach ($transaction->massage as $key => $data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            @if ($data->status == 'Menunggu Pembayaran')
                                                                <span class="badge badge-warning badge-pill px-25">
                                                                    {{ $data->status }}</span>
                                                            @elseif($data->status == 'Proses')
                                                                <span class="badge badge-info badge-pill px-25">
                                                                    {{ $data->status }}</span>
                                                            @elseif($data->status == 'Selesai')
                                                                <span class="badge badge-success badge-pill px-25">
                                                                    {{ $data->status }}</span>
                                                            @else
                                                                <span class="badge badge-danger badge-pill px-25">
                                                                    {{ $data->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $data->message }}</td>
                                                        <td>{{ $data->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (Auth::user()->role == 'Petani')
                                        @if ($transaction->status == 'Menunggu Pembayaran' || $transaction->status == 'Proses')
                                            <hr>
                                            <h4>Form Konfirmasi Pembayaran</h4>
                                            <hr>
                                            <form action="/transactions/confirm" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $transaction->id }}">
                                                <div class="row">
                                                    <div class="col-lg-8 col-12">
                                                        <div class="form-group">
                                                            <label>Pesan</label>
                                                            <input type="text" name="message" class="form-control"
                                                                value="{{ old('message') }}">
                                                            @error('message')
                                                                <small
                                                                    class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <label>Tipe</label>
                                                            <select class="form-control" name="status">
                                                                <option selected value="">Pilih Tipe</option>
                                                                <option value="Selesai"
                                                                    {{ old('status') == 'Selesai' ? 'selected' : '' }}>
                                                                    Selesai
                                                                </option>
                                                                <option value="Ditolak"
                                                                    {{ old('status') == 'Ditolak' ? 'selected' : '' }}>
                                                                    Ditolak
                                                                </option>
                                                            </select> @error('status')
                                                                <small
                                                                    class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        @endif
                                    @endif

                                    @if ($transaction->status == 'Menunggu Pembayaran' || $transaction->status == 'Proses')
                                        @if ($transaction->image)
                                            <hr />
                                            <h4>Bukti Pembayaran</h4>
                                            <hr>
                                            <div class="text-center">
                                                <img src="{{ asset($transaction->image) }}" width="500" alt="">
                                            </div>
                                        @else
                                            @if (Auth::user()->role == 'Tengkulak')
                                                <hr />
                                                <h4>Bukti Pembayaran</h4>
                                                <hr>
                                                <div>
                                                    <form action="/transactions" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $transaction->id }}">
                                                        <input type="file" name="image" class="form-control"
                                                            required>
                                                        <button type="submit"
                                                            class="btn w-100 btn-info btn-bold px-4 mt-2">Kirim
                                                            Bukti
                                                            Pembayaran</button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>
@endpush
