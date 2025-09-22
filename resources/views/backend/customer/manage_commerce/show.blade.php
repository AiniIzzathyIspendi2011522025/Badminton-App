@extends('layouts.landing.home')

@section('css')
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel="stylesheet" href="{{ asset('templates/css/custom/selectgroup.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/chatPopup/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">

        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-top">
                        <div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="w-100" src="{{ asset('images/venue/' . $venue->FirstImage()->image) }}"
                                        alt="First slide" style="height: 400px">
                                </div>
                                @foreach ($venue->VenueImage as $VenueImage)
                                    <div class="carousel-item">
                                        <img class="w-100" src="{{ asset('images/venue/' . $VenueImage->image) }}"
                                            alt="Second slide" style="height: 400px">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="product-details product-details-sidebar">
                                    <h1 class="product-title">{{ $venue->name }}</h1>
                                    <h6>{{ $venue->address }}</h6>
                                    <h6>{{ $venue->phone_number }}</h6>
                                    <h6>{{ $venue->information }}</h6>
                                    <!-- End .product-title -->
                                    {{-- <div class="product-price">
                                    {{Helper::rupiah($venue->rangePrice('asc')->price)}} -
                                    {{Helper::rupiah($venue->rangePrice('desc')->price)}}
                                </div><!-- End .product-price --> --}}
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                            <div class="col">
                                {{-- <div class="product-details product-details-sidebar">
                                    <br>
                                    <p><b>Opening Hours</b></p>
                                    @foreach ($openingHours as $openingHour)
                                        <p><b>- {{ $openingHour->Day->name }} :</b></p>
                                        <div class="badges">
                                            @foreach ($venue->OpeningHour as $open)
                                                @if ($openingHour->day_id == $open->day_id)
                                                    @if ($open->status == 2)
                                                        @if ($open->checkAvailable())
                                                            <span
                                                                class="badge badge-success">{{ $open->Hour->hour }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $open->Hour->hour }}</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div> --}}
                                <div class="p-3 mb-2"
                                    style="border-radius: 8px; width: 35rem; margin-left: auto;
                                    box-shadow:rgba(37, 40, 43, 0.08) 0px 1px 6px 0px">
                                    <h5 class="text-center">Ketersedian Lapangan</h5>
                                    <a href="#jadwal-lapangan" style="border-radius: 6px"
                                        class="btn btn-primary mx-auto d-block">
                                        <span>Cek Sekarang</span>
                                    </a>

                                </div>
                                @php
                                    use Carbon\Carbon;

                                    $now = Carbon::today();

                                    $hasMembership = !empty($membership);
                                    $status        = $hasMembership ? (int) $membership->membership_status : null;

                                    $expired = $hasMembership
                                        && $membership->end_date
                                        && Carbon::parse($membership->end_date)->lt($now);

                                    // Tampilkan tombol join jika:
                                    // - venue mendukung membership, dan
                                    // - belum punya membership, atau sudah expired, atau statusnya bukan aktif(1)/menunggu(2)
                                    $canJoin = ($venue->isMembership == 1) && (
                                        !$hasMembership
                                        || $expired
                                        || !in_array($status, [1, 2])   // <-- status 3 (REJECTED) akan lolos di sini
                                    );

                                    $isWaiting = $hasMembership && $status === 2;
                                    $isActive  = $hasMembership && $status === 1 && !$expired;
                                @endphp

                                @if (Auth::check())
                                    @if ($canJoin)
                                        <div class="p-3 mb-5"
                                            style="border-radius: 8px; width: 35rem; margin-left: auto;
                                                    box-shadow: rgba(37, 40, 43, 0.08) 0px 1px 6px 0px;">
                                            <div class="card-body">
                                                <h5 class="card-subtitle text-muted mb-1 text-center">Membership</h5>
                                                <h6 class="mb-1 text-center">Jadi membership dan dapatkan lebih banyak keuntungan</h6>
                                                <a href="/membership/{{ $venue->id }}" class="btn btn-primary mx-auto d-block" style="border-radius: 6px">
                                                    <span>Gabung Membership</span>
                                                </a>
                                            </div>
                                        </div>
                                    @elseif ($isWaiting)
                                        <div class="alert alert-warning" style="width: 35rem; margin-left: auto; border-radius: 8px;">
                                            Pengajuan membership Anda sedang menunggu konfirmasi.
                                        </div>
                                    @elseif ($isActive)
                                        <div class="alert alert-success" style="width: 35rem; margin-left: auto; border-radius: 8px;">
                                            Membership aktif hingga {{ \Carbon\Carbon::parse($membership->end_date)->format('d/m/Y') }}.
                                        </div>
                                    @endif
                                @endif


                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->

                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-field-link" data-toggle="tab"
                                    href="#product-field-tab" role="tab" aria-controls="product-field-tab"
                                    aria-selected="false">Lapangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                    role="tab" aria-controls="product-info-tab" aria-selected="false">Fasilitas</a>
                            </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link" id="product-map-link" data-toggle="tab" href="#product-map-tab"
                                role="tab" aria-controls="product-map-tab" aria-selected="true">Map</a>
                        </li> --}}
                            {{-- <li class="nav-item">
                            <a class="nav-link" id="product-gallery-link" data-toggle="tab" href="#product-gallery-tab"
                                role="tab" aria-controls="product-gallery-tab" aria-selected="true">Gallery Venue</a>
                        </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                    role="tab" aria-controls="product-desc-tab" aria-selected="true">Informasi
                                    Pemilik &
                                    Pembayaran</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-field-tab" role="tabpanel"
                                aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                                        data-toggle="owl"
                                        data-owl-options='{
                                                    "nav": false,
                                                    "dots": true,
                                                    "margin": 20,
                                                    "loop": false,
                                                    "responsive": {
                                                        "0": {
                                                            "items":1
                                                        },
                                                        "480": {
                                                            "items":2
                                                        },
                                                        "768": {
                                                            "items":3
                                                        },
                                                        "992": {
                                                            "items":4
                                                        },
                                                        "1200": {
                                                            "items":4,
                                                            "nav": true,
                                                            "dots": false
                                                        }
                                                    }
                                                }'>
                                        @foreach ($field as $field)
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    <img src="{{ asset('images/field/' . $field->image) }}"
                                                        alt="Product image" class="product-image"
                                                        style="width: 300px; height: 150px;">
                                                    </a>
                                                </figure><!-- End .product-media -->

                                                <div class="product-body">
                                                    <div class="product-cat" style="color:grey;">
                                                        {{ $field->fieldType->name }}
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title">{{ $field->name }}</h3>
                                                    <!-- End .product-title -->
                                                    <div class="product-price">

                                                    </div><!-- End .product-price -->

                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        @endforeach

                                    </div><!-- End .owl-carousel -->
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                                aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    <div>
                                        <div>
                                            @foreach ($venue->ActiveFacilityDetail() as $facility)
                                                <p class="badge badge-info" style="padding:10px;">
                                                    {{ $facility->Facility->name }}
                                                </p>
                                            @endforeach
                                            @if ($venue->OtherFacility)
                                                @foreach ($venue->OtherFacility as $OtherFacility)
                                                    <p class="badge badge-info" style="padding:10px;">
                                                        {{ $OtherFacility->name }}
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-map-tab" role="tabpanel"
                                aria-labelledby="product-map-link">
                                <div class="product-map-content">
                                    <div class="google-map" id="map-show" style="height:400px"></div>

                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-gallery-tab" role="tabpanel"
                                aria-labelledby="product-gallery-link">
                                <div class="product-desc-content">
                                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                                        data-toggle="owl"
                                        data-owl-options='{
                                                    "nav": false,
                                                    "dots": true,
                                                    "margin": 20,
                                                    "loop": false,
                                                    "responsive": {
                                                        "0": {
                                                            "items":1
                                                        },
                                                        "480": {
                                                            "items":2
                                                        },
                                                        "768": {
                                                            "items":3
                                                        },
                                                        "992": {
                                                            "items":4
                                                        },
                                                        "1200": {
                                                            "items":4,
                                                            "nav": true,
                                                            "dots": false
                                                        }
                                                    }
                                                }'>
                                        @foreach ($venue->VenueImage as $VenueImage)
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    <img src="{{ asset('images/venue/' . $VenueImage->image) }}"
                                                        alt="Product image" class="product-image"
                                                        style="width: 300px; height: 150px;">
                                                </figure><!-- End .product-media -->
                                            </div><!-- End .product -->
                                        @endforeach

                                    </div><!-- End .owl-carousel -->
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-desc-tab" role="tabpanel"
                                aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <div class="row">
                                        <div class="col-4">
                                            <ul>Nama Pemilik : {{ $venue->owner->first_name }}
                                                {{ $venue->owner->last_name }}</ul>
                                            <ul>No Hp Pemilik : {{ $venue->owner->handphone }}</ul>
                                            <ul>Alamat Pemilik : {{ $venue->owner->address }}</ul>
                                        </div>
                                        <div class="col-4">
                                            <p>Metode Pembayaran</p>
                                            @foreach ($venue->paymentMethodDetail as $paymentMethodDetail)
                                                <p>- {{ $paymentMethodDetail->PaymentMethod->name }} (
                                                    {{ $paymentMethodDetail->no_rek }} )</p>
                                            @endforeach
                                        </div>
                                        <div class="col-4">
                                            <p>Jenis Pembayaran</p>
                                            @if ($venue->dp_percentage != null)
                                                <p><b>- Pembayaran dengan DP sebesar {{ $venue->dp_percentage }} %</b></p>
                                                <p><b>- Pembayaran Lunas</b></p>
                                            @else
                                                <p><b>- Pembayaran Lunas</b></p>
                                            @endif
                                            <b></b>
                                        </div>
                                    </div>

                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->


                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->
                    @include('backend.customer.manage_booking.create')

                </div><!-- End .col-lg-9 -->


            </div><!-- End .row -->


        </div><!-- End .container -->
    </div><!-- End .page-content -->
@endsection

@section('script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.toastrDefaultWarning').click(function() {
                toastr.warning('harap login terlebih dahulu')
            });
        });


        let mapCreate;
        let mapShow;
        let markers = [];
        // When the window has finished loading google map
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions1 = {
                zoom: 17,
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
            var mapElement3 = document.getElementById('map-show');

            // Create the Google Map using elements
            var map = new google.maps.Map(mapElement3, mapOptions1);


            // Variabel untuk menyimpan batas kordinat
            bounds = new google.maps.LatLngBounds();



            $.ajax({
                url: "{{ url('api/venue/get-location') }}?id={{ $venue->id }}",
                dataType: 'json',
                cache: false,
                dataSrc: '',

                success: function(data) {
                    var latitude = data.map(function(item) {
                        return item.latitude;
                    });
                    var longitude = data.map(function(item) {
                        return item.longitude;
                    });
                    var latlng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
                    console.log(latitude);
                    console.log(longitude);
                    for (i = 0; i < data.length; i++) {
                        var pos = {
                            lat: parseFloat(latitude[i]),
                            lng: parseFloat(longitude[i])
                        };
                        var marker = new google.maps.Marker({
                            position: pos,
                            map: map,
                            title: 'Lokasi Anda',
                            icon: '{{ asset('templates/img/venue_map.png') }}',
                            draggable: true,
                            animation: google.maps.Animation.DROP
                        });
                        marker.setMap(map);
                        map.setCenter(latlng);
                        // for(i=0; i<arrays.length; i++){
                        //     var data = arrays
                        //     console.log(data.properties.center['latitude']);
                        // }
                    }
                }

            });
        }

        $('#c_field').prop("disabled", false);
        $('#c_venue').prop("disabled", true);


        function dateChange() {
            $('#c_field').prop("disabled", false);
            $(".selectgroup-item").remove();
        }

        $('#c_select_field').prop("disabled", true);

        function dateChange() {
            $('#c_select_field').prop("disabled", false);
            $('#c_select_field').val(0).change();
            $(".selectgroup-item").remove();
        }
        $('#c_select_field').on('change', function(e) {
            let venue_id = $('#c_venue').val();
            var field_id = $('#c_select_field').val();
            var date = $('#c_date').val();
            $.ajax({
                url: "{{ url('api/select/schedule') }}?venue_id=" + venue_id + "&field_id=" + field_id +
                    "&date=" + date,
                dataType: 'json',
                cache: false,
                dataSrc: '',

                success: function(data) {
                    var detail_id = data.map(function(item) {
                        return item.detail_id;
                    });
                    var price = data.map(function(item) {
                        return item.price;
                    });
                    var hour = data.map(function(item) {
                        return item.hour;
                    });
                    var available = data.map(function(item) {
                        return item.available;
                    });

                    $(".selectgroup-item").remove();
                    for (i = 0; i < data.length; i++) {
                        if (available[i] == 2) {
                            var div = `<label class="selectgroup-item">
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input"
                                                disabled>
                                            <span class="selectgroup-button" style="background-color:red; color:white">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        } else if (available[i] == 3) {
                            var div = `<label class="selectgroup-item">
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input" disabled>
                                            <span class="selectgroup-button" style="background-color:grey; color:white">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        } else {
                            var div = `<label class="selectgroup-item">
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input">
                                            <span class="selectgroup-button">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        }

                        $("#hour-checkbox").append(div);
                    }

                    console.log(data)
                }

            });
        });

        var radio = 1;

        function checkbox(data) {
            let checked = [];
            for (var i = 0; i < $('.selectgroup-input').length; i++) {
                if ($('.selectgroup-input').eq(i).prop('checked') == true) {
                    checked.push($('.selectgroup-input').eq(i).val());
                }
            }
            $.post(
                "{{ url('api/pricing/set-price') }}", {
                    id: checked,
                    status: radio,
                    venue_id: "{{ $venue->id }}"
                },
                function(result) {
                    $('#price').val(result.price).change();
                    $('#dp').val(result.dp).change();
                }
            )
        }

        $(':radio').on('click', function(e) {
            if ($(this).val() == 1) {
                radio = 1;
                $('#col-dp').hide();
                $('#dp').val(0).change();
            } else {
                radio = 2;
                $('#col-dp').show();
            }

        });
    </script>
@endsection
