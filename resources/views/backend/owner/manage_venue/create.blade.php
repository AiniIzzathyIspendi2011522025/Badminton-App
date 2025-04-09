@extends('layouts.owner.home')

@section('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="{{ asset('templatesAdminLTE/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('templatesAdminLTE/plugins/steps/jquery.steps.css') }}" rel="stylesheet">


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
                    <h1>Tambah Lapangan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('owner.venue.index') }}">Kelola Lapangan</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Lapangan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="ibox-content">
                                <h2>
                                </h2>
                                <p>
                                </p>
                                {{ Form::open(['url' => route('owner.venue.store'), 'id' => 'form', 'files' => true, 'class' => 'wizard-big']) }}
                                <h1>Informasi Umum</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Nama Lapangan</label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="name" type="text" class="form-control" id="c_name"
                                                        placeholder="Input Nama Lapangan" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Nomor Handphone</label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="phone_number" type="phone" class="form-control"
                                                        id="c_phone_number" placeholder="Input No Handphone" required>
                                                    @error('phone_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><br>
                                            <div class="row" style="display:none;">
                                                <div class="col-4">
                                                    <label for="name">Status</label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="status" type="text" class="form-control" id="c_status"
                                                        placeholder="Masukkan nama lapangan anda">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="name">Deskripsi</label>
                                                </div>
                                                <div class="col-8">
                                                    <textarea id="c_information" placeholder="Input informasi lainnya" class="form-control" name="information"></textarea>
                                                    @error('information')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="name">Upload IMB</label>
                                                </div>
                                                <div class="col-8">
                                                    <div style="background-color: #6FB6A6"
                                                        class="fileinput fileinput-new rounded text-white"
                                                        data-provides="fileinput">
                                                        <span class="btn btn-file text-white"><span
                                                                class="fileinput-new">Upload
                                                                IMB</span>
                                                            <span class="fileinput-exists">Change</span><input required
                                                                type="file" id="imb" name="imb"
                                                                onchange="return fileValidation()" /></span>
                                                        <span class="fileinput-filename"></span>
                                                        <a href="#" class="close fileinput-exists"
                                                            data-dismiss="fileinput" style="float: none"
                                                            onclick="removeImage()">×</a>
                                                    </div>
                                                    <!-- Image preview -->
                                                    <div id="imagePreview"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Alamat</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Alamat</label>
                                                </div>
                                                <div class="col-8">
                                                    <textarea class="form-control" placeholder="Input your venue's address" name="address" required></textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Koordinat</label>
                                                </div>
                                                <div class="col-4">
                                                    <input name="latitude" class="form-control" id="c_latitude"
                                                        placeholder="Latitude" required>
                                                </div>
                                                <div class="col-4">
                                                    <input name="longitude" class="form-control" id="c_longitude"
                                                        placeholder="Longitude" required>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <Button class="btn btn-outline-primary" id="get-location"
                                                        type="button" style="margin-top:5px;">Gunakan Lokasi Anda
                                                    </Button>
                                                </div>
                                                <div class="col-8">
                                                    <div class="google-map" id="map-marker" style="height:200px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Pembayaran</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Pembayaran dengan DP</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="selectgroup selectgroup-pills">
                                                        <label class="selectgroup-item">
                                                            <input id="check-dp" type="checkbox" name="check-dp"
                                                                value="check-dp" class="selectgroup-input"
                                                                onclick="check()">
                                                            <span class="selectgroup-button">Tambah</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row" style="display:none" id="row-dp">
                                                <div class="col-4">
                                                    <label for="field_name">Input % DP</label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="dp_percentage" type="number" class="form-control"
                                                        id="c_dp_percentage" placeholder="Input your dp percentage">
                                                    @error('dp_percentage')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Pilih Metode Pembayaran</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="selectgroup selectgroup-pills">
                                                        @foreach ($payment_methods as $payment_method)
                                                            <label class="selectgroup-item">
                                                                <input type="checkbox"
                                                                    name="payment_method[{{ $payment_method->id }}]"
                                                                    value="{{ $payment_method->id }}"
                                                                    class="selectgroup-input checkbox-paymentMethod"
                                                                    onclick="addPaymentMethod()">
                                                                <span
                                                                    class="selectgroup-button mr-5">{{ $payment_method->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top: 20px" class="form-row" id="row-paymentMethod">
                                                <!-- Add Payment Method -->
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Fasilitas</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="selectgroup selectgroup-pills">
                                                @foreach ($facilities as $facility)
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox" name="facility[{{ $facility->id }}]"
                                                            value="{{ $facility->id }}" class="selectgroup-input">
                                                        <span class="selectgroup-button mr-3">{{ $facility->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Membership</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="selectgroup selectgroup-pills">
                                                        <label class="selectgroup-item">
                                                            <input id="checkedMembership" type="checkbox"
                                                                name="membership" class="selectgroup-input"
                                                                onchange="toogleMembership()">
                                                            <span class="selectgroup-button"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="inputMembership" style="display:none">
                                                <div class="form-row row-facility" id="row-facility">
                                                    <div class="form-group col-md-8">
                                                        <input name="membership_discount" type="number"
                                                            class="form-control mb-1" id="membership"
                                                            placeholder="Masukkan Diskon Membership (%)" min="1"
                                                            max="99">
                                                        <input name="membership_price" type="number"
                                                            class="form-control" id="membership"
                                                            placeholder="Masukkan Harga Membership" min="1000">
                                                        @error('membership')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Fasilitas Lainnya</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="selectgroup selectgroup-pills">
                                                        <label class="selectgroup-item">
                                                            <input id="other" type="checkbox" name="other"
                                                                value="other" class="selectgroup-input"
                                                                onclick="otherFacility()">
                                                            <span class="selectgroup-button"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="toggle-otherFacility" style="display:none">
                                                <div class="form-row row-facility" id="row-facility">
                                                    <div class="form-group col-md-8">
                                                        <input name="other_facility[]" type="text"
                                                            class="form-control" id="c_other_facility"
                                                            placeholder="Tambah fasilitas">
                                                        @error('other_facility')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <a href="javascript:0" class="btn btn-outline-danger"
                                                            onclick="delOtherFacilityClone(this)">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <a href="javascript:0" class="btn btn-outline-primary"
                                                onclick="otherFacilityClone()">Tambah</a>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Jadwal Buka</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="control-label" style="display: flex; justify-content: left;">
                                                </div>
                                                @foreach ($days as $day)
                                                    <label
                                                        style="display: flex; justify-content: left;font-weight:bold;">{{ $day->name }}</label>
                                                    <label class="custom-switch">
                                                        <div
                                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="day{{ $day->id }}"
                                                                name="day[{{ $day->id }}]"
                                                                value="{{ $day->id }}"
                                                                onchange="return selectDay({{ $day->id }})">
                                                            <label id="status{{ $day->id }}"
                                                                class="custom-control-label"
                                                                for="day{{ $day->id }}">Close</label>
                                                        </div>
                                                    </label>
                                                    <div id="select{{ $day->id }}" style="display:none">
                                                        <div class="custom-switches-stacked mt-6">
                                                            @foreach ($hours as $hour)
                                                                <label class="selectgroup-item ml-4">
                                                                    <input type="checkbox"
                                                                        id="hour{{ $day->id }}{{ $hour->id }}"
                                                                        name="hour[{{ $day->id }}][{{ $hour->id }}]"
                                                                        value="{{ $hour->id }}"
                                                                        class="selectgroup-input day{{ $day->id }}">
                                                                    <span class="selectgroup-button mr-4">
                                                                        <?php
                                                                        $time = strtotime($hour->hour);
                                                                        echo date('H:i', $time);
                                                                        ?>
                                                                    </span>
                                                                </label>
                                                            @endforeach

                                                        </div>
                                                        @if ($day->id != 7)
                                                            <a href="javascript:void(0)" style="background-color: #6FB6A6"
                                                                class="btn text-white font-weight-medium rounded-5 mb-2"
                                                                onclick="duplicate({{ $day->id }})">Copy to next
                                                                day</a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Gambar Lapangan</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="javascript:;" onclick="cloneImage()"
                                                class="btn btn-outline-secondary btn-sm">
                                                <i class="fa fa-plus-square"></i> Tambah gambar
                                            </a>
                                            <div class="form-group row">
                                                <div class="col-4 clone-1" id="clone-1">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                                            <img src="{{ asset('templates/img/placeholder.png') }} "
                                                                style="width:180px; float:center; margin:auto"
                                                                alt="...">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists img-thumbnail"
                                                            style="max-width: 200px; max-height: 150px;"></div>
                                                        <div>
                                                            <span class="btn btn-outline-secondary btn-file"><span
                                                                    class="fileinput-new">Select
                                                                    image</span><span
                                                                    class="fileinput-exists">Change</span><input
                                                                    type="file" name="image_venue[]"></span>
                                                            <a href="#"
                                                                class="btn btn-outline-secondary fileinput-exists"
                                                                data-dismiss="fileinput">Remove</a>
                                                            <a href="javascript:;" onclick="delClone(this)"
                                                                class="btn btn-outline-secondary">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                {{-- @include('backend.owner.manage_venue.formcreate') --}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('script')
    <!-- Steps -->
    <script src="{{ asset('templatesAdminLTE/plugins/steps/jquery.steps.min.js') }}"></script>

    <!-- Jquery Validate -->
    <script src="{{ asset('templatesAdminLTE/plugins/steps/jquery.validate.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('templates/js/stisla.js') }}"></script>
    <script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('templatesAdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>



    <script>
        $(document).ready(function() {

            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function(event, currentIndex, newIndex) {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18) {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex) {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function(event, currentIndex, priorIndex) {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3) {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function(event, currentIndex) {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function(event, currentIndex) {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                errorPlacement: function(error, element) {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });
        });

        function fileValidation() {
            var fileInput = document.getElementById('imb');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png/.pdf only.');
                fileInput.value = '';
                return false;
            } else {
                //Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = '<iframe id="image" src="' + e.target
                            .result +
                            '" style="width: 100%; height: 100%;"></iframe>';
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

        function addPaymentMethod() {
            let checked = [];
            for (var i = 0; i < $('.checkbox-paymentMethod').length; i++) {
                if ($('.checkbox-paymentMethod').eq(i).prop('checked') == true) {
                    checked.push($('.checkbox-paymentMethod').eq(i).val());
                }
            }
            console.log(checked);
            $.post(
                "{{ url('api/payment/add-paymentMethod') }}", {
                    "_token": "{{ csrf_token() }}",
                    id: checked
                },
                function(result) {
                    console.log(result.length)
                    $('.method').remove();
                    for (var i = 0; i < result.length; i++) {
                        var div = $(`<div class="form-row method">
                                <div class="form-group col-md-4">
                                    <label>` + result[i].name + `</label>
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="no_rek[]" type="text"
                                        placeholder="Nomor rekening"
                                        class="form-control" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <input name="payment_methods[]" type="hidden"
                                            value="` + result[i].id + `"
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

        function toogleMembership() {
            const checkMember = document.getElementById('checkedMembership')
            const toogleMembership = document.getElementById('inputMembership')
            const inputMembership = document.getElementById('membership')

            if (checkMember.checked) {
                toogleMembership.style.display = 'block'
                inputMembership.required = true
            } else {
                toogleMembership.style.display = 'none'
                inputMembership.required = false
            }
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

            google.maps.event.addListener(mapCreate, 'click', function(e) {
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
                .addEventListener("click", function() {
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
