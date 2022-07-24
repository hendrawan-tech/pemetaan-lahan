@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lahan</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Lahan</h6>
            </div>
            <div class="card-body">
                <form action="/lands" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Jenis Tanaman</label>
                                <select class="form-control" name="plant_type_id">
                                    <option selected value="">Pilih Jenis Tanaman</option>
                                    @foreach ($plants as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('plant_type_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select> @error('plant_type_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="text" name="lattitude" class="form-control"
                                    value="{{ old('lattitude') }}">
                                @error('lattitude')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Lattitude</label>
                                <input type="text" name="longitude" class="form-control"
                                    value="{{ old('longitude') }}">
                                @error('longitude')
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
