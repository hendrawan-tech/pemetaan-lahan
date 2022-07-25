@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title">{{ $product->land->name }}
                            </h5>
                            <h5><span
                                    class="badge badge-lg {{ $product->land->status == 'Sudah Panen' ? 'badge-success' : 'badge-danger' }}">{{ $product->land->status }}</span>
                            </h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div style="width: 100%; height: 400px;">
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
                                                        <h5 class="card-title">{{ $product->user->name }}
                                                        </h5>
                                                        <span class="card-text">{{ $product->user->email }}</span>
                                                        <br>
                                                        <span class="card-text">{{ $product->user->phone }}</span>
                                                    </div>
                                                    <hr>
                                                    <div style="width: 100px; height: 100px; border-radius: 100%;">
                                                        <img src="{{ $product->user->image == '' ? 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png' : asset($product->user->image) }}"
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="font-weight-bold">Deskripsi Produk : </p>
                                <p class="card-text">{{ $product->description }}</p>
                            </div>
                        </div>
                        @if (!Auth::guest())
                            @if (Auth::user()->role == 'Tengkulak')
                                @if ($total > $limit->limit && $product->status == 'Tersedia')
                                    <a href="/cart/{{ $product->id }}"
                                        class="btn btn-primary {{ $total > $limit->limit ? 'd-block' : 'd-none' }}">Tambah
                                        Ke Keranjang</a>
                                @endif
                            @endif
                        @else
                            <a href="/login"
                                class="btn btn-primary d-block">Tambah
                                Ke Keranjang</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
