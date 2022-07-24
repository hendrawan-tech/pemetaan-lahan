@extends('layouts.front')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title">Data Barang</h5>
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-12">
                                    <div class="card mb-4">
                                        <div style="width: 100%; height: 300px;">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="card-title">{{ $product->name }}
                                                </h5>
                                                <span
                                                    class="badge {{ $product->status == 'Tersedia' ? 'badge-success' : 'badge-danger' }}">{{ $product->status }}</span>
                                            </div>
                                            <span class="card-text">Harga : {{ Helper::price($product->price) }} /kg</span>
                                            <br>
                                            <span class="card-text">Jumlah Stok : {{ $product->stok }}</span>
                                            <div class="card my-4">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h6 class="card-title">{{ $product->user->name }}
                                                            </h6>
                                                            <span class="text-muted">{{ $product->user->email }}</span>
                                                            <br>
                                                            <span class="text-muted">{{ $product->user->phone }}</span>
                                                        </div>
                                                        <hr>
                                                        <div style="width: 50px; height: 50px; border-radius: 100%;">
                                                            <img src="{{ $product->user->avatar == '' ? 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png' : asset($product->user->avatar) }}"
                                                                alt="{{ $product->user->name }}"
                                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 100%;">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="text-left">
                                                        <p class="font-weight-bold">Alamat : </p>
                                                        <p class="card-text">{{ $product->user->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="font-weight-bold">Deskripsi Produk : </p>
                                            <p class="card-text">{{ $product->description }}</p>
                                            @if (Auth::user()->role == 'Pembeli')
                                                @if ($product->status == 'Tersedia')
                                                    <a href="/cart/{{ $product->id }}"
                                                        class="btn btn-primary w-full d-block">Tambah
                                                        Ke Keranjang</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
