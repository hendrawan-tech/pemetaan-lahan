@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rekening</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Rekening</h6>
            </div>
            <div class="card-body">
                <form action="/payments/{{ $payment->id }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $payment->name }}">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Bank</label>
                                <input type="text" name="bank" class="form-control" value="{{ $payment->bank }}">
                                @error('bank')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>No Rekening</label>
                                <input type="text" name="number" class="form-control" value="{{ $payment->number }}">
                                @error('number')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/payments" class="d-none d-sm-inline-block mr-2 btn btn-sm pt-2 btn-secondary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-gray-50"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
