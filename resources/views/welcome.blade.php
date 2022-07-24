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
        var map = L.map('map').setView([-7.710526, 113.522840], 15);
        L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var petani = L.icon({
            iconUrl: "{{ asset('assets/onion.png') }}",
            iconSize: [80, 80],
            iconAnchor: [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor: [-3, -76]
        });

        var tengkulak = L.icon({
            iconUrl: "{{ asset('assets/supermarket.png') }}",
            iconSize: [40, 40],
            iconAnchor: [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor: [-3, -76]
        });

        var polygon = L.polygon([
            [
                113.52267265319824,
                -7.7067601697936485
            ],
            [
                113.51990461349487,
                -7.710289954710446
            ],
            [
                113.52544069290161,
                -7.710608909728678
            ],
            [
                113.52267265319824,
                -7.7067601697936485
            ]
        ]).addTo(map);

        $(document).ready(function() {
            $.getJSON('/get-map', function(data) {
                $.each(data, function(i) {
                    var marker = L.marker([parseFloat(data[i]
                        .longitude), parseFloat(data[i].lattitude)], {
                        icon: petani
                    }).addTo(
                        map)
                    marker.on('click', function() {
                        var content = `<div>
                        <div class="card-body p-0 pt-2 m-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title">
                                    ${data[i].name}
                                </h5>
                            </div>
                            <span class="card-text">Status : ${data[i].status}</span>
                            <br>
                            ${data[i].product.length > 0 ?` ${data[i].product[0].status == 'Proses' ? '' : `<span class="card-text">Produk : ${data[i].product[0].name}</span></br>
                                                        <span class="card-text">Status : ${data[i].product[0].status}</span><br>
                                                        <span class="card-text">Harga : ${data[i].product[0].price} /kg</span><br>
                                                    <span class="card-text">Jumlah Stok : ${data[i].product[0].stok}</span><br>
                                                    <a href="/cart/${data[i].product[0].id}" class="btn btn-sm ` +
                                                                                                                        `<?= $total > $limit->limit ? 'd-block' : 'd-none' ?>` + ` text-white btn-primary mt-3">+Keranjang</a>`} `
                                            : ``}
                            ${data[i].product.length > 0 ?` <a href="/product/${data[i].product[0].id}" class="btn btn-outline-primary btn-sm d-block text-primary mt-1">Lihat Detail</a>`
                            : ``}
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
            $.getJSON('/get-geo', function(geo) {
                $.each(geo, function(i) {
                    var marker = L.marker([parseFloat(geo[i]
                        .longitude), parseFloat(geo[i].lattitude)], {
                        icon: tengkulak
                    }).addTo(
                        map)
                    marker.on('click', function() {
                        var content = `<div>
                    <div class="card-body p-0 pt-2 m-0">
                        <h5 class="card-title">
                            ${geo[i].name}
                        </h5>
                        <span class="card-text">Produk : ${geo[i].product.length}</span>
                        ${geo[i].product.length > 0 ? `<a href="/product/tengkulak/${geo[i].id}" class="btn btn-outline-primary btn-sm d-block text-primary mt-1">Lihat Detail</a>` : ``}
                    </div>`
                        L.popup()
                            .setLatLng([parseFloat(geo[i].longitude), parseFloat(geo[i]
                                .lattitude)])
                            .setContent(content)
                            .openOn(map);
                    })
                })
            })
        })
    </script>
@endpush
