@extends('layouts.owner.home')

@section('css')

<!-- multi-step -->
<link rel="stylesheet" href="{{ asset('templates/css/styleStep.css') }}">
<!-- Normalize CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link href="{{ asset('templates/css/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
<!-- Telephone Input CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css'>
<!-- Icons CSS -->
<link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
<!-- Nice Select CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css'>




@endsection

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Venue</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('owner.venue.index') }}">Kelola Venue</a>
                    </li>
                    <li class="breadcrumb-item active">Add Venue</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <section class="multi_step_form">
                        {{ Form::open(array('url' => route('owner.venue.store'), 'files' => true, 'id' => 'msform')) }}
                        <!-- <form id="msform"> -->
                        <!-- Tittle -->
                        <!-- <div class="tittle">
                    <h2>Step To Add Venue</h2>
                </div> -->
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active">General Information</li>
                            <li>Address & Coordinate</li>
                            <li>Payment</li>
                            <li>Facility</li>
                            <li>Opening Hours</li>
                            <li>Image</li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset required>
                            <h3>General Information</h3>
                            <h6>Please enter general information of your venue</h6>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Venue Name</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="name" type="text" class="form-control" id="c_name"
                                        placeholder="Input your venue's name" required>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Venue Phone</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="phone_number" type="phone" class="form-control" id="c_phone_number"
                                        placeholder="Input your venue's phone number">
                                    @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row" style="display:none;">
                                <div class="form-group col-md-4">
                                    <label for="status">Status</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="status" type="text" class="form-control" id="c_status"
                                        placeholder="Masukkan nama venue anda">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Venue Information</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <textarea id="c_information" placeholder="Input your venue's information"
                                        class="form-control" name="information" required=""></textarea>
                                    @error('information')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Upload Surat IMB Venue</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-outline-dark btn-file"><span
                                                class="fileinput-new">Upload IMB</span>
                                            <span class="fileinput-exists">Change</span><input type="file" id="imb"
                                                name="imb" onchange="return fileValidation()" /></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none"
                                            onclick="removeImage()">×</a>
                                    </div>
                                    <!-- Image preview -->
                                    <div id="imagePreview"></div>
                                </div>
                            </div>
                            
                            <br><br>

                            <button type="button" class="action-button previous_button">Back</button>
                            <button type="button" class="next action-button">Continue</button>
                        </fieldset>

                        <fieldset required>
                            <h3>Venue Address & Coordinate</h3>
                            <h6>Please enter the address and coordinates of your venue</h6>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="address">Address :</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <textarea class="form-control" placeholder="Input your venue's address"
                                        name="address" required=""></textarea>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="address">Coordinate :</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input name="latitude" class="form-control" id="c_latitude" placeholder="Latitude">
                                </div>
                                <div class="form-group col-md-4">
                                    <input name="longitude" class="form-control" id="c_longitude"
                                        placeholder="Longitude">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">

                                    <Button class="btn btn-outline-primary" id="get-location" type="button"
                                        style="margin-top:5px;">Use your location
                                    </Button>
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="google-map" id="map-marker" style="height:200px"></div>
                                </div>
                            </div>
                            <br><br>

                            <button type="button" class="action-button previous previous_button">Back</button>
                            <button type="button" class="next action-button">Continue</button>
                        </fieldset>

                        <fieldset required>
                            <h3>Payment</h3>
                            <h6>Please enter the address and coordinates of your venue</h6>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Pembayaran dengan DP</label>
                                </div>
                                <div class="form-group col-md-8">   
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input id="check-dp" type="checkbox" name="check-dp"
                                                value="check-dp" class="selectgroup-input" onclick="check()">
                                            <span class="selectgroup-button">Tambah</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" style="display:none"  id="row-dp">
                                <div class="form-group col-md-4">
                                    <label for="name">Input % pembayaran DP</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="dp_percentage" type="number" class="form-control" id="c_dp_percentage"
                                        placeholder="Input your dp percentage">
                                    @error('dp_percentage')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Choose Payment Method</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="selectgroup selectgroup-pills">
                                        @foreach($payment_methods as $payment_method)
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="payment_method[{{$payment_method->id}}]"
                                                value="{{$payment_method->id}}" class="selectgroup-input checkbox-paymentMethod" onclick="addPaymentMethod()">
                                            <span class="selectgroup-button">{{$payment_method->name}}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" id="row-paymentMethod">
                                <!-- Add Payment Method -->
                            </div>
                            <br><br>

                            <button type="button" class="action-button previous previous_button">Back</button>
                            <button type="button" class="next action-button">Continue</button>
                        </fieldset>

                        <fieldset required>
                            <h3>Fasilitas / Layanan Venue</h3>
                            <h6>Please choose your venue's facility</h6>
                            <div class="form-group">
                                <div class="selectgroup selectgroup-pills">
                                    @foreach($facilities as $facility)
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="facility[{{$facility->id}}]"
                                            value="{{$facility->id}}" class="selectgroup-input">
                                        <span class="selectgroup-button">{{$facility->name}}</span>
                                    </label>
                                    @endforeach
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Fasilitas Lainnya</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="selectgroup selectgroup-pills">
                                            <label class="selectgroup-item">
                                                <input id="check-dp" type="checkbox" name="check-dp"
                                                    value="check-dp" class="selectgroup-input" onclick="otherFacility()">
                                                <span class="selectgroup-button"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="toggle-otherFacility" style="display:none">
                                    <div class="form-row row-facility" id="row-facility">
                                        <div class="form-group col-md-8">
                                            <input name="other_facility[]" type="text" class="form-control" id="c_other_facility"
                                                placeholder="Tambah fasilitas">
                                            @error('other_facility')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <a href="javascript:0" class="btn btn-outline-primary" onclick="otherFacilityClone()">Tambah</a>
                                            <a href="javascript:0" class="btn btn-outline-danger" onclick="delOtherFacilityClone(this)">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>

                            <button type="button" class="action-button previous previous_button">Back</button>
                            <button type="button" class="next action-button">Continue</button>


                        </fieldset>

                        <fieldset required>
                            <h3>Opening Hours</h3>
                            <h6>Please choose your venue's opening hours</h6>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="control-label" style="display: flex; justify-content: left;"></div>
                                        <div class="custom-switches-stacked mt-2"
                                            style="display: flex; justify-content: left;">
                                            @foreach ($days as $day)
                                            <label
                                                style="display: flex; justify-content: left;font-weight:bold;">{{ $day->name }}</label>
                                            <label class="custom-switch">
                                                <input type="checkbox" name="day[{{$day->id}}]" id="day{{$day->id}}"
                                                    value="{{$day->id}}" class="custom-switch-input"
                                                    onchange="return selectDay({{$day->id}})">
                                                <span class="custom-switch-indicator"></span>
                                                <span id="status{{$day->id}}"
                                                    class="custom-switch-description">Close</span>
                                            </label>
                                            <div id="select{{$day->id}}" style="display:none">
                                                <div class="selectgroup selectgroup-pills">
                                                    @foreach($hours as $hour)
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" id="hour{{$day->id}}{{$hour->id}}"
                                                            name="hour[{{$day->id}}][{{$hour->id}}]"
                                                            value="{{$hour->id}}"
                                                            class="selectgroup-input day{{$day->id}}">
                                                        <span class="selectgroup-button">
                                                            <?php
                                                    $time = strtotime($hour->hour);
                                                    echo date('H:i', $time); 
                                                ?>
                                                        </span>
                                                    </label>
                                                    @endforeach
                                                </div>
                                                @if ($day->id != 7)
                                                <a href="javascript:void(0)" class="btn btn-danger"
                                                    onclick="duplicate({{$day->id}})">Copy to next day</a>

                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <button type="button" class="action-button previous previous_button">Back</button>
                            <button type="button" class="next action-button">Continue</button>
                        </fieldset>

                        <fieldset required>
                            <h3>Venue Image</h3>
                            <h6>Please upload your venue image here</h6>
                            <a href="javascript:;" onclick="cloneImage()" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-plus-square"></i> Tambah gambar
                            </a>
                            <div class="form-group row">
                                <div class="col-4 clone-1" id="clone-1">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                            <img src="{{ asset('templates/img/upload.png') }} "
                                                style="width:80px; height:80px; float:center; margin:auto" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists img-thumbnail"
                                            style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-outline-secondary btn-file"><span
                                                    class="fileinput-new">Select
                                                    image</span><span class="fileinput-exists">Change</span><input
                                                    type="file" name="image_venue[]"></span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                                data-dismiss="fileinput">Remove</a>
                                            <a href="javascript:;" onclick="delClone(this)"
                                                class="btn btn-outline-secondary">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <button type="button" class="action-button previous previous_button">Back</button>
                            <button type="submit" class="action-button">Finish</button>

                        </fieldset>


                        <!-- </form> -->
                        {!! Form::close() !!}
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@section('script')
<!-- multi step -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'>
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'>
</script>
<script src="{{ asset('templates/js/script.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('templates/js/stisla.js') }}"></script>
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script>
    function fileValidation() {
        var fileInput = document.getElementById('rule_upload');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').innerHTML = '<img id="image" src="' + e.target.result +
                        '" style="width: 200px; height: 150px;"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    function removeImage() {
        var image = document.getElementById('image');
        var preview = document.getElementById('imagePreview');
        preview.removeChild(image);
    }

    function addPaymentMethod(){
        let checked = [];
        for(var i=0; i<$('.checkbox-paymentMethod').length ;i++)
        {  
            if ($('.checkbox-paymentMethod').eq(i).prop('checked')==true){ 
                checked.push($('.checkbox-paymentMethod').eq(i).val());
            }
        }
        console.log(checked);
        $.post(
            "{{url('api/payment/add-paymentMethod')}}", 
            {
                "_token": "{{ csrf_token() }}",
                id: checked
            }, 
            function(result){
                console.log(result.length)
                $('.method').remove();
                for(var i=0; i<result.length; i++)
                {
                    var div = $(`<div class="form-row method">
                                <div class="form-group col-md-4">
                                    <label>`+result[i].name+`</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="no_rek[]" type="text"
                                        placeholder="Nomor rekening"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="payment_methods[]" type="hidden"
                                            value="`+result[i].id+`"
                                            class="form-control">
                                </div>
                            </div>`);

                    $('#row-paymentMethod').append(div);
                }
                
            }
        )
    }

    function duplicate(id) {
        var next = id + 1;
        for (var i = 1; i <= $('.day' + id).length; i++) {
            if ($('#hour' + id + i).prop("checked") == true) {
                $('#hour' + next + i).prop("checked", true);
            }
        }
        $('#select' + next).toggle();
        if ($('#select' + next).is(":visible")) {
            document.getElementById('status' + next).innerHTML = "Open";
            $('#day' + next).prop("checked", true);
        } else {
            document.getElementById('status' + next).innerHTML = "Close";
            $('#day' + next).prop("checked", false);
        }

    }

    
    function check() {
        $("#row-dp").toggle(this.checked);
    }

    function otherFacility() {
        $(".toggle-otherFacility").toggle(this.checked);
    }

    function otherFacilityClone() {
        $("#row-facility")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".row-facility:last");
    }

    function delOtherFacilityClone(data) {
        if ($('.row-facility').length > 1) data.closest('.row-facility').remove();
    }

    function selectDay($id) {
        //console.log($id);
        $('#select' + $id).toggle();
        if ($('#select' + $id).is(":visible")) {
            document.getElementById('status' + $id).innerHTML = "Open";
        } else {
            document.getElementById('status' + $id).innerHTML = "Close";
        }

    }

    function cloneImage() {
        $("#clone-1")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".clone-1:last");
    }

    function delClone(data) {
        console.log(data.closest('.clone-1'));
        if ($('.clone-1').length > 1) {
            data.closest('.clone-1').remove()
        } else {
            swal({
                title: "Warning!",
                text: "Select at least one image",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        };
    }

    // Proses membuat marker 
    let mapCreate;
    let markers = [];
    // When the window has finished loading google map
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
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

        var mapElement2 = document.getElementById('map-marker');

        var mapCreate = new google.maps.Map(mapElement2, mapOptions1);

        google.maps.event.addListener(mapCreate, 'click', function (e) {
            if (markers.length > 0) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
            }

            $('#c_latitude').val(e.latLng.lat);
            $('#c_longitude').val(e.latLng.lng);

            var marker = new google.maps.Marker({
                position: e["latLng"],
                title: "Hello world!"
            });
            markers.push(marker);
            marker.setMap(mapCreate);
        });

        // Variabel untuk menyimpan batas kordinat
        bounds = new google.maps.LatLngBounds();


        document
            .getElementById("get-location")
            .addEventListener("click", function () {
                getLocation(mapCreate);
            });
    }

    function getLocation(mapCreate) {
        // Geolokasi / lokasi sendiri
        console.log('sampai sini');
        var infoWindow = new google.maps.InfoWindow({
            map: mapCreate
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
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
            }, function () {
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