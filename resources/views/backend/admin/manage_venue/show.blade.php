@extends('layouts.admin.home')

@section('css')
<link rel="stylesheet" href="{{ asset('templates/css/components.css') }}">
<link href="{{asset('templates/js/plugins/dataTables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail {{$venues->name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.venue.index.admin') }}">Kelola Venue</a>
                    </li>
                    <li class="breadcrumb-item active">Detail Venue </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary btn-icon icon-left btn-lg btn-block mb-4 d-md-none"
                                    data-toggle-slide="#ticket-items">
                                </a>
                                <div class="tickets">
                                    <div class="ticket-items" id="ticket-items">
                                        <div class="gallery gallery-fw" data-item-height="400">
                                            <strong>
                                                <center>Surat IMB</center>
                                            </strong>
                                            @if ($venues->imb == NULL)
                                                <div class="gallery-item"
                                                    data-image="{{ asset('templates/img/no_image.jpg') }}">
                                                </div>
                                            @else
                                                <div class="gallery-item"
                                                    data-image="{{ asset('images/imb/'.$venues->imb) }}">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ticket-content">
                                        <div class="ticket-header">
                                            <div class="ticket-sender-picture img-shadow">
                                                @if ($venues->owner->avatar == NULL)
                                                    <img src="{{ asset('templates/img/avatar/avatar-5.png') }}" alt="image">
                                                @else
                                                    <img src="{{ asset('images/owner/'.$venues->owner->avatar) }}" alt="image">
                                                @endif
                                            </div>
                                            <div class="ticket-detail">
                                                <div class="ticket-title">
                                                    <h4>{{$venues->owner->first_name}} {{$venues->owner->last_name}}
                                                    </h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div class="font-weight-600">Owner {{$venues->name}}</div>
                                                    <div class="bullet"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ticket-description">
                                            <h6><b>No Handphone</b></h6>
                                            <p>{{$venues->owner->handphone}}</p>
                                            <h6><b>Alamat</b></h6>
                                            <p>{{$venues->address}}</p>
                                            <h6><b>Foto KTP</b></h6>
                                            <p>
                                                <figure>
                                                    <img style="width:300px;;height:200px;"
                                                        src="{{ asset('images/ktp/'.$venues->owner->ktp) }}" alt="">
                                                </figure>
                                            </p>

                                            <div class="ticket-divider"></div>

                                            <div class="ticket-form">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">{{$venues->name}}</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#"
                                        class="btn btn-primary btn-icon icon-left btn-lg btn-block mb-4 d-md-none"
                                        data-toggle-slide="#ticket-items">
                                    </a>
                                    <div class="tickets">
                                        <div class="ticket-items" id="ticket-items">
                                            <div class="gallery gallery-fw" data-item-height="100">
                                                <?php 
                                        $i=1;
                                        $count = $venues->VenueImage->count();
                                    ?>
                                                @foreach ($venues->VenueImage as $VenueImage)
                                                @if ($i < 4) @if ($i==3) <div class="gallery-item gallery-more"
                                                    id="more-image" onclick="more_image()"
                                                    data-image="{{ asset('images/venue/'.$VenueImage->image) }}"
                                                    data-title="Image {{$i}}">
                                                    <div id="total">+{{$count - $i}}</div>
                                            </div>
                                            @else
                                            <div class="gallery-item"
                                                data-image="{{ asset('images/venue/'.$VenueImage->image) }}"
                                                data-title="Image {{$i}}">
                                            </div>
                                            @endif
                                            @endif

                                            <?php $i++; ?>
                                            @endforeach
                                        </div>
                                        <div class="google-map" id="map-show" style="height:200px"></div>
                                    </div>
                                    <div class="ticket-content">
                                        <div class="ticket-header">
                                            <div class="ticket-detail">
                                                <div class="ticket-title">
                                                    <h4>{{$venues->name}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ticket-description">
                                            <h6>Informasi Venue</h6>
                                            <p>{{ $venues->information }}</p>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6>Alamat</h6>
                                                    <p>{{ $venues->address }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <h6>Jenis Pembayaran</h6>
                                                    @if ($venues->dp_percentage != NULL)
                                                    <p><b>- Pembayaran dengan DP sebesar {{$venues->dp_percentage}}
                                                            %</b>
                                                        <br>
                                                        <b>- Pembayaran Lunas</b>
                                                    </p>
                                                    @else
                                                    <p><b>- Pembayaran Lunas</b></p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <h6>Fasilitas</h6>
                                                    @foreach($venues->ActiveFacilityDetail() as $facility)
                                                        @if ($facility->Facility->icon != null)
                                                        <span class="d-inline-block" data-toggle="tooltip"
                                                            data-title="{{$facility->Facility->name}}"
                                                            data-placement="right">
                                                            <a class="btn btn-icon btn-sm btn-secondary"><i
                                                                    class="{{$facility->Facility->icon}}"></i></a>
                                                        </span>
                                                        @else
                                                        <span class="d-inline-block" data-toggle="tooltip"
                                                            data-title="{{$facility->Facility->name}}"
                                                            data-placement="right">
                                                            <a class="btn btn-icon btn-sm btn-secondary"><i
                                                                    class="fa fa-check"></i></a>
                                                        </span>
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if ($venues->OtherFacility)
                                                        @foreach ($venues->OtherFacility as $OtherFacility)
                                                        <span class="d-inline-block" data-toggle="tooltip"
                                                            data-title="{{$OtherFacility->name}}"
                                                            data-placement="right">
                                                            <a class="btn btn-icon btn-sm btn-secondary"><i
                                                                    class="fa fa-check"></i></a>
                                                        </span>
                                                        @endforeach
                                                    @endif

                                                </div>
                                                <div class="col-6">
                                                    <h6>Metode Pembayaran</h6>
                                                    <p>
                                                        @foreach($venues->PaymentMethodDetail as $payment)
                                                        <b>- {{$payment->PaymentMethod->name}} ( {{$payment->no_rek}}
                                                            )</b>
                                                        <br>
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-striped dataTables-field" id="table-2">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Lapangan</th>
                                                                <th>Tipe Lapangan</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                    </table>
                                                </div>
                                                <div class="col-lg-6">

                                                </div>
                                            </div>



                                            <div class="ticket-divider"></div>

                                            <div class="ticket-form">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <h4> Opening Hours</h4>
                                <div class="row">
                                    @foreach ($openingHours as $openingHour)
                                    <div class="col-md-6">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h4>{{$openingHour->Day->name}}</h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="badges">
                                                    @foreach($venues->OpeningHour as $open)
                                                    @if($openingHour->day_id == $open->day_id)
                                                    @if ($open->status == 2)
                                                    <span class="badge badge-primary">{{$open->Hour->hour}}</span>
                                                    @else
                                                    <span class="badge badge-secondary">{{$open->Hour->hour}}</span>
                                                    @endif

                                                    @endif
                                                    @endforeach
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>


@endsection

@section('script')
<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- Data tables -->
<script src="{{asset('templates/js/plugins/dataTables/datatables.bundle.js')}}" type="text/javascript"></script>

<script src="https:/cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('templates/js/scripts.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.dataTables-field').DataTable({

            responsive: true,
            searching: false,
            lengthChange: false,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/field')}}?data=all&&id={{$venues->id}}",
                dataSrc: ''
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'field_type'
                },
                {
                    data: 'id',
                    responsivePriority: -1
                },
            ],
            columnDefs: [{
                targets: -1,
                title: "Action",
                orderable: false,
                render: function (data, type, full, meta) {
                    var base = "{{url('/')}}";
                    return `` +
                        ` <a class="btn btn-icon icon-left btn-outline-dark btn-sm " href="/owner/venue/` +
                        data +
                        `/field-show"><i class="fas fa-file-alt"></i> Detail Jadwal & Biaya</a>` +
                        ``;
                },
            }, ],
        });

    });

    function remove_image() {
        $('.remove-image').remove();
        $('.gallery-more').attr("onClick", "more_image()");
        $('#total').show();
    }

    function more_image() {
        console.log('success');
        $('.gallery-more').removeAttr("onClick");
        $.ajax({
            url: "{{url('api/venue/get-image')}}?venue_id={{$venues->id}}",
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var image = data.map(function (item) {
                    return item.image;
                });
                console.log(data.length);
                for (i = 0; i < data.length; i++) {
                    if (i > 2 && i < data.length - 1) {
                        var row = $(
                            `<div class="gallery-item remove-image" data-image="{{ asset('images/venue/` +
                            image[i] + `') }}" data-title="Image " href="{{ asset('images/venue/` +
                            image[i] +
                            `') }}" title="Image 3" style="height: 100px; background-image: url(&quot;{{ asset('images/venue/` +
                            image[i] + `') }}&quot;);"></div>`);
                        $('.gallery-fw').append(row);
                    } else if (i == data.length - 1) {
                        var row = $(
                            `<div onclick="remove_image()" class="gallery-item remove-image gallery-more" data-image="{{ asset('images/venue/` +
                            image[i] + `') }}" data-title="Image " href="{{ asset('images/venue/` +
                            image[i] +
                            `') }}" title="Image 3" style="height: 100px; background-image: url(&quot;{{ asset('images/venue/` +
                            image[i] + `') }}&quot;);"><div>Back</div></div>`);
                        $('.gallery-fw').append(row);
                    }
                }
                $('#total').hide();

            }

        });
    }

    let mapCreate;
    let mapShow;
    let markers = [];
    // When the window has finished loading google map
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions1 = {
            zoom: 12,
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
            url: "{{url('api/venue/get-location')}}?id={{$venues->id}}",
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var latitude = data.map(function (item) {
                    return item.latitude;
                });
                var longitude = data.map(function (item) {
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
                        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
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
</script>
@endsection