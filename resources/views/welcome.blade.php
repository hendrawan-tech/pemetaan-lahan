@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="map"></div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #map {
            height: 80vh;
        }
    </style>
@endpush

@push('scripts')
    <script>
        var map = L.map('map').setView([-7.9036416, 113.8294784], 15);
        L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        $(document).ready(function() {
            $.getJSON('/get-map', function(data) {
                $.each(data, function(i) {
                    var marker = L.marker([parseFloat(data[i].longitude), parseFloat(data[i]
                        .lattitude)]).addTo(
                        map)
                    marker.on('click', function() {
                        var content = `<div>
                        <div class="card-body p-0 pt-2 m-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title">
                                    ${data[i].name}
                                </h5>
                            </div>
                            <span class="card-text">Produk : ${data[i].product[0].name}</span>
                            <br>
                            <span class="card-text">Harga : ${data[i].product[0].price} /kg</span>
                            <br>
                            <span class="card-text">Jumlah Stok : ${data[i].product[0].stok}</span>
                            <a href="/product/$item->id" class="btn btn-sm `+ `<?= $total > $limit->limit ? 'd-block' : 'd-none' ?>` +` text-white btn-primary mt-3">+Keranjang</a>
                            <a href="/product/${data[i].product[0].id}" class="btn btn-outline-primary btn-sm d-block text-primary mt-1">Lihat Detail</a>
                        </div>
                    </div>`
                        L.popup()
                            .setLatLng([parseFloat(data[i].longitude), parseFloat(data[i]
                                .lattitude)])
                            .setContent(content)
                            .openOn(map);
                    })
                })
            })
        })
    </script>
@endpush
