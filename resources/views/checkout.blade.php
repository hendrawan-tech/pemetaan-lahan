@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ Auth::user()->role == 'Tengkulak' ? 'Akun Petani' : 'Akun Tengkulak' }}</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($petani as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <b class="text-dark">{{ $item['user']->name }}</b>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <b>{{ $item['user']->email }}</b>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <b>{{ $item['user']->phone }}</b>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Pembelian</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <b class="text-dark">Total Pembelian ({{ count($carts) }})</b>
                        </div>
                        @foreach ($carts as $item)
                            <div class="d-flex justify-content-between align-items-center">
                                <b>{{ $item->product->name }} ({{ $item->quantity }})</b>
                                <p>{{ Helper::price($item->product->price * $item->quantity) }}</p>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            @php
                                $total = 0;
                                for ($i = 0; $i < count($carts); $i++) {
                                    $total += $carts[$i]->product->price * $carts[$i]->quantity;
                                }
                            @endphp
                            <b class="text-dark">Total Harga</b>
                            <h5>{{ Helper::price($total) }}</h5>
                        </div>
                        <hr>
                        <form action="/cart/checkout" method="POST">
                            <input type="hidden" name="role" value="{{ Auth::user()->role }}">
                            @csrf
                            <b class="text-dark mb-2">Metode Pembayaran</b>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        @foreach ($petani as $item)
                                            <label class="mt-2">{{ $item['user']->name }}</label>
                                            <select class="form-control" name="payment_id[]" required>
                                                <option selected value="">Pilih Metode Pembayaran</option>
                                                @foreach ($item['payment'] as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->bank }}
                                                    </option>
                                                @endforeach
                                            </select> @error('payment_id[]')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
