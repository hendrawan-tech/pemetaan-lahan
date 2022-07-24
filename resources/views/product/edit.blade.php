@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Panen</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Panen</h6>
            </div>
            <div class="card-body">
                <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="name"
                                    {{ Auth::user()->role == 'Tengkulak' ? 'disabled' : '' }} class="form-control"
                                    value="{{ $product->name }}">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Harga / Kilo</label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                                @error('price')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Jumlah Panen (Kilo)</label>
                                @if (Auth::user()->role == 'Tengkulak')
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                @endif
                                <input type="number" name="stok" class="form-control"
                                    {{ Auth::user()->role == 'Tengkulak' ? 'max=' . $product->stok . '' : '' }}
                                    value="{{ $product->stok }}">
                                @error('stok')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Foto Produk</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea type="text" name="description" rows="3" class="form-control">{{ $product->description }}</textarea>
                                @error('description')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/lands" class="d-none d-sm-inline-block mr-2 btn btn-sm pt-2 btn-secondary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-gray-50"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
