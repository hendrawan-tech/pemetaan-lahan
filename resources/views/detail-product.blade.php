@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div style="width: 100%; height: 500px;">
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
                        <span class="card-text">Harga : {{ $product->price }} /kg</span>
                        <br>
                        <span class="card-text">Jumlah Stok : {{ $product->stok }}</span>
                        <hr>
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="/product/{{ $product->id }}" class="btn d-block btn-primary">Tambah Ke Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
