@extends('layouts.landing.home')

@section('content')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">


                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Menampilkan <span>{{ $venues->count() }}</span> Venue
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-info">

                            </div><!-- End .toolbox-sort -->
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->
                    <!-- <div id="map" style="width:100%;height:380px;"></div> -->
                    <br>
                    <div class="products mb-3">
                        <div class="row">
                            @foreach ($venues as $venue)
                                <div class="col-6 col-md-4 col-xl-3">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{ route('commerce.show', $venue->id) }}">
                                                <img src="{{ asset('images/venue/' . $venue->FirstImage()->image) }}"
                                                    alt="Venue" class="product-image" style="height: 120px;">
                                            </a>
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="{{ route('commerce.show', $venue->id) }}">
                                                    {{ $venue->name }}</a></h3>
                                            <!-- End .product-title -->
                                            <div class="product-price">
                                            </div><!-- End .product-price -->
                                            <div>
                                                <span>{{ $venue->address }}</span>
                                            </div><!-- End .rating-container -->
                                            {{-- <div class="product-price">
                                        <small style="font-size:10px;">Mulai dari</small>
                                           <b>&nbsp;{{Helper::rupiah($venue->rangePrice('asc')->price)}} </b>
                                    </div><!-- End .product-price --> --}}
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-md-4 col-xl-3 -->
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .products -->

                    <nav aria-label="Page navigation">
                        {{ $venues->appends(Request::except('page'))->links('layouts.pagination.pagination') }}
                    </nav>
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3 col-xl-5col order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Seacrh By :</label>
                        </div><!-- End .widget widget-clean -->
                        <div class="widget">
                            <h3 class="widget-title">
                                Nama Venue
                            </h3>
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    <div class="filter-item">
                                        <ul>
                                            <li><a href="{{ route('commerce.sortByName') }}?data=1"><i
                                                        class="fa fa-hand-o-right"></i> Ascending</a></li>
                                            <li><a href="{{ route('commerce.sortByName') }}?data=2"><i
                                                        class="fa fa-hand-o-right"></i> Descending</a></li>
                                            {{-- <li><a href="#" onclick="sortByAround()"><i
                                                        class="fa fa-hand-o-right"></i> Di
                                                    sekitar anda</a></li> --}}
                                        </ul>
                                    </div><!-- End .filter-item -->
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .widget -->
                        <div class="widget">
                            <h3 class="widget-title">
                                Tipe Lapangan
                            </h3>
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    <div class="filter-item">
                                        <ul>
                                            <li><a href="{{ route('commerce.sortByType') }}?type=7"><i
                                                        class="fa fa-hand-o-right"></i> Lapangan Karpet</a></li>
                                            <li><a href="{{ route('commerce.sortByType') }}?type=8"><i
                                                        class="fa fa-hand-o-right"></i> Lapangan Semen</a></li>
                                            <li><a href="{{ route('commerce.sortByType') }}?type=9"><i
                                                        class="fa fa-hand-o-right"></i> Lapangan Kayu</a></li>
                                        </ul>
                                    </div><!-- End .filter-item -->
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .widget -->

                        <!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div>
    {!! Form::open([
        'method' => 'POST',
        'route' => ['commerce.sortByAround'],
        'style' => 'display.none',
        'id' => 'sortby_around',
    ]) !!}
    <input id="around_latitude" type="hidden" name="latitude">
    <input id="around_longitude" type="hidden" name="longitude">
    {!! Form::close() !!}
    <?php
    $venue_id = collect([]);
    foreach ($venues as $venue) {
        $venue_id->push($venue->id);
    }
    ?>
@endsection

@section('script')
    <script>
        function sortByAround() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    $('#around_latitude').val(position.coords.latitude).change();
                    $('#around_longitude').val(position.coords.longitude).change();
                    $('#sortby_around').submit();
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        google.maps.event.addDomListener(window, 'load', init);

        let map;
        let infoWindow;
        let mapOptions;
        let bounds;
        let latitude;
        let longitude;
        let markers = [];

        function init() {
            infoWindow = new google.maps.InfoWindow;
            var mapOptions1 = {
                zoom: 13,
                center: new google.maps.LatLng(-0.9111111111111111, 100.34972222222221),
                // Style for Google Maps
                styles: [{
                    "featureType": "water",
                    "stylers": [{
                        "saturation": 43
                    }, {
                        "lightness": -11
                    }, {
                        "hue": "#0088ff"
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "hue": "#ff0000"
                    }, {
                        "saturation": -100
                    }, {
                        "lightness": 99
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#808080"
                    }, {
                        "lightness": 54
                    }]
                }, {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ece2d9"
                    }]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ccdca1"
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#767676"
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "landscape.natural",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "color": "#b8cb93"
                    }]
                }, {
                    "featureType": "poi.park",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi.sports_complex",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi.medical",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi.business",
                    "stylers": [{
                        "visibility": "simplified"
                    }]
                }]
            };
            // Get all html elements for map
            var mapElement1 = document.getElementById('map');

            // Create the Google Map using elements
            var map = new google.maps.Map(mapElement1, mapOptions1);


            // Variabel untuk menyimpan batas kordinat
            bounds = new google.maps.LatLngBounds();
            var infoWindow = new google.maps.InfoWindow({
                map: map
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    $('#c_latitude').val(position.coords.latitude);
                    $('#c_longitude').val(position.coords.longitude);

                    if (markers.length > 0) {
                        for (let i = 0; i < markers.length; i++) {
                            markers[i].setMap(null);
                        }
                    }


                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: 'Lokasi Anda',
                        icon: '{{ asset('templates/img/user_map.png') }}',
                        draggable: true,
                        animation: google.maps.Animation.DROP
                    });
                    markers.push(marker);

                    marker.addListener('click', toggleBounce);

                    function toggleBounce() {
                        if (marker.getAnimation() !== null) {
                            marker.setAnimation(null);
                        } else {
                            marker.setAnimation(google.maps.Animation.BOUNCE);
                        }
                    }
                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Anda Disini');
                    map.setCenter(pos);

                    $.post(
                        "{{ url('api/map/get-venueAround') }}", {
                            "_token": "{{ csrf_token() }}",
                            venue_id: {{ $venue_id }}
                        },
                        function(result) {
                            console.log(result);
                            for (var i = 0; i < result.length; i++) {
                                var pos = {
                                    lat: parseFloat(result[i].latitude),
                                    lng: parseFloat(result[i].longitude)
                                };
                                console.log(result[i].name);
                                var content = `<div> <center>
                                                <strong>` + result[i].name + `</strong>
                                                </center>
                                            </div>`;
                                addMarker(result[i].latitude, result[i].longitude, content);
                            }
                            var location;
                            var marker;

                            function addMarker(lat, lng, info) {
                                location = new google.maps.LatLng(lat, lng);
                                bounds.extend(location);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: location,
                                    icon: '{{ asset('templates/img/venue_map.png') }}',
                                    animation: google.maps.Animation.DROP
                                });
                                map.fitBounds(bounds);
                                bindInfoWindow(marker, map, infoWindow, info);
                            }
                            // Proses ini dapat menampilkan informasi lokasi Kota/Kab ketika diklik dari masing-masing markernya
                            function bindInfoWindow(marker, map, infoWindow, html) {
                                google.maps.event.addListener(marker, 'click', function() {
                                    infoWindow.setContent(html);
                                    infoWindow.open(map, marker);
                                });
                            }

                        }
                    )
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
                handleLocationError(false, infoWindow, map.getCenter());
            }



        }

        function getLocation(mapCreate) {
            // Geolokasi / lokasi sendiri
            var infoWindow = new google.maps.InfoWindow({
                map: mapCreate
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    console.log(position.coords.latitude);
                    console.log(position.coords.longitude);

                    if (markers.length > 0) {
                        for (let i = 0; i < markers.length; i++) {
                            markers[i].setMap(null);
                        }
                    }


                    var marker = new google.maps.Marker({
                        position: pos,
                        map: mapCreate,
                        title: 'Lokasi Anda',
                        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
                        draggable: true,
                        animation: google.maps.Animation.DROP
                    });
                    markers.push(marker);

                    marker.addListener('click', toggleBounce);

                    function toggleBounce() {
                        if (marker.getAnimation() !== null) {
                            marker.setAnimation(null);
                        } else {
                            marker.setAnimation(google.maps.Animation.BOUNCE);
                        }
                    }
                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Anda Disini');
                    map.setCenter(pos);


                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
                handleLocationError(false, infoWindow, map.getCenter());
            }

        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent('Error: Kesalahan layanan geolokasi.' +
                'Error: <i>Browser</i> anda tidak mendukung geolokasi.');
        }
    </script>
@endsection
