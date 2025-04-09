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
                    <h1>Edit Venue</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('owner.venue.index') }}">Kelola Lapangan</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Lapangan</li>
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
                                @if ($venues->status == 2)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5 style="color:red">
                                                <center>
                                                    <b>Lapangan anda ditolak !</b><br>
                                                    <b>{{ $venues->reject_note }}</b>
                                                </center>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                {{ Form::open(['method' => 'PATCH', 'url' => route('owner.venue.update', $venues->id), 'files' => true, 'id' => 'form', 'class' => 'wizard-big']) }}
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
                                                        value="{{ $venues->name }}" placeholder="Masukkan nama venue anda">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">No Handphone</label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="phone_number" type="phone" class="form-control"
                                                        id="c_phone_number" value="{{ $venues->phone_number }}"
                                                        placeholder="Input your venue's phone number">
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
                                                        placeholder="Masukkan nama venue anda">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="name">Informasi Tambahan</label>
                                                </div>
                                                <div class="col-8">
                                                    <textarea id="c_information" placeholder="Masukkan informasi venue anda" class="form-control" name="information"
                                                        required="">{{ $venues->information }}</textarea>
                                                    @error('information')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="name">Upload Surat IMB</label>
                                                </div>
                                                <div class="col-8">
                                                    <div @if ($venues->imb) class="fileinput fileinput-exists"
                                                    @else
                                                    class="fileinput fileinput-new" @endif
                                                        data-provides="fileinput">
                                                        <span class="btn btn-outline-dark btn-file"><span
                                                                class="fileinput-new">Upload IMB</span>
                                                            <span class="fileinput-exists">Change</span><input
                                                                type="file" id="imb" name="imb"
                                                                onchange="return fileValidation()"
                                                                @if ($venues->imb) value="{{ $venues->imb }}" file="{{ $venues->imb }}" @endif></span>
                                                        <span class="fileinput-filename">
                                                            {{ $venues->imb }}
                                                        </span>
                                                        <a href="#" class="close fileinput-exists"
                                                            data-dismiss="fileinput" style="float: none"
                                                            onclick="removeImage()">×</a>
                                                    </div>
                                                    <!-- Image preview -->
                                                    <div id="imagePreview">
                                                        @if ($venues->imb)
                                                            <img id="image"
                                                                src="{{ asset('images/imb/' . $venues->imb) }}"
                                                                style="width: 100%; height: 100%;"></img>
                                                        @endif
                                                    </div>
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
                                                    <textarea class="form-control" name="address" required="">{{ $venues->address }}</textarea>
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
                                                    <input name="latitude" value="{{ $venues->latitude }}"
                                                        class="form-control" id="c_latitude" placeholder="Latitude">
                                                </div>
                                                <div class="col-4">
                                                    <input name="longitude" value="{{ $venues->longitude }}"
                                                        class="form-control" id="c_longitude" placeholder="Longitude">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-4">
                                                    <Button class="btn btn-outline-primary" id="get-location"
                                                        type="button" style="margin-top:5px;">Use your location
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
                                                        <div class="selectgroup selectgroup-pills">
                                                            <label class="selectgroup-item">
                                                                <input id="check-dp" type="checkbox" name="check-dp"
                                                                    value="check-dp" class="selectgroup-input"
                                                                    onclick="check()"
                                                                    @if ($venues->dp_percentage) checked @endif>
                                                                <span class="selectgroup-button">Tambah</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row"
                                                @if (!$venues->dp_percentage) style="display:none" @endif
                                                id="row-dp">
                                                <div class="col-4">
                                                    <label for="field_name">Input % pembayaran DP</label>
                                                </div>
                                                <div class="col-8">
                                                    <input name="dp_percentage" type="number" class="form-control"
                                                        id="c_dp_percentage" placeholder="Input your dp percentage"
                                                        value="{{ $venues->dp_percentage }}">
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
                                                                    onclick="addPaymentMethod()"
                                                                    @if ($payment_method->isChecked($venues->id)) checked @endif>
                                                                <span
                                                                    class="selectgroup-button">{{ $payment_method->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="row-paymentMethod">
                                                <!-- Add Payment Method -->
                                                @if ($venues->paymentMethodDetail)
                                                    @foreach ($venues->paymentMethodDetail as $paymentMethodDetail)
                                                        <div class="form-group row method">
                                                            <label
                                                                class="col-4 col-form-label">{{ $paymentMethodDetail->paymentMethod->name }}</label>
                                                            <div class="col-7">
                                                                <input name="no_rek[]" type="text"
                                                                    placeholder="Nomor rekening"
                                                                    value="{{ $paymentMethodDetail->no_rek }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-1">
                                                                <input name="payment_methods[]" type="hidden"
                                                                    value="{{ $paymentMethodDetail->payment_method_id }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Fasilitas</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="selectgroup selectgroup-pills">
                                                @foreach ($facilitie_details as $facilitie_detail)
                                                    <label class="selectgroup-item">
                                                        <input type="checkbox"
                                                            name="facility[{{ $facilitie_detail->id }}]"
                                                            value="{{ $facilitie_detail->id }}" class="selectgroup-input"
                                                            @if ($facilitie_detail->status == 2) checked @endif>
                                                        <span
                                                            class="selectgroup-button">{{ $facilitie_detail->facility->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="field_name">Membership</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="selectgroup selectgroup-pills">
                                                        <label class="selectgroup-item">
                                                            <input id="checkedMembership" type="checkbox"
                                                                name="membership" class="selectgroup-input"
                                                                onchange="toogleMembership()"
                                                                @if ($venues->isMembership === 1) checked @endif>
                                                            <span class="selectgroup-button"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="inputMembership" style="display:none">
                                                <div class="form-row row-facility" id="row-facility">
                                                    <div class="form-group col-md-8">
                                                        <label for="membership_discount">Diskon Membership</label>
                                                        <input name="membership_discount" type="number"
                                                            class="form-control mb-1" id="membership"
                                                            placeholder="Masukkan Diskon Membership (%)" min="1"
                                                            max="99" value="{{ $venues->membership_discount }}">
                                                        <label for="membership_discount">Harga Membership</label>
                                                        <input name="membership_price" type="number"
                                                            class="form-control" id="membership"
                                                            placeholder="Masukkan Harga Membership"
                                                            value="{{ $venues->membership_price }}" min="1000">
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
                                                            <input id="check-dp" type="checkbox" name="check-dp"
                                                                value="check-dp" class="selectgroup-input"
                                                                onclick="otherFacility()"
                                                                @if ($other_facilities->count() > 0) checked @endif>
                                                            <span class="selectgroup-button"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="toggle-otherFacility"
                                                @if ($other_facilities->count() == 0) style="display:none" @endif>
                                                @foreach ($other_facilities as $other_facility)
                                                    <div class="form-row row-facility">
                                                        <div class="form-group col-md-8">
                                                            <input name="other_facility[]" type="text"
                                                                class="form-control" id="c_other_facility"
                                                                value="{{ $other_facility->name }}"
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
                                                @endforeach
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
                                                <div class="form-group col-md-4">
                                                    <a href="javascript:0" class="btn btn-outline-primary"
                                                        onclick="otherFacilityClone()">Tambah</a>
                                                </div>
                                            </div>
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
                                                                onchange="return selectDay({{ $day->id }})"
                                                                @if ($day->checkOpeningHour($venues->id, $day->id)) checked @endif>
                                                            <label id="status{{ $day->id }}"
                                                                class="custom-control-label"
                                                                for="day{{ $day->id }}">
                                                                @if ($day->checkOpeningHour($venues->id, $day->id))
                                                                    open
                                                                @else
                                                                    close
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </label>
                                                    <div id="select{{ $day->id }}"
                                                        @if ($day->checkOpeningHour($venues->id, $day->id) == false) style="display:none" @endif>
                                                        <div class="custom-switches-stacked mt-6">
                                                            @foreach ($hours as $hour)
                                                                <label class="selectgroup-item">
                                                                    <input type="checkbox"
                                                                        id="hour{{ $day->id }}{{ $hour->id }}"
                                                                        name="hour[{{ $day->id }}][{{ $hour->id }}]"
                                                                        value="{{ $hour->id }}"
                                                                        class="selectgroup-input day{{ $day->id }}"
                                                                        @if ($day->checkOpeningHour($venues->id, $day->id)) @if ($hour->checkOpeningHour($venues->id, $day->id, $hour->id))
                                                                checked @endif
                                                                        @endif
                                                                    >
                                                                    <span class="selectgroup-button">
                                                                        <?php
                                                                        $time = strtotime($hour->hour);
                                                                        echo date('H:i', $time);
                                                                        ?>
                                                                    </span>
                                                                </label>
                                                            @endforeach

                                                        </div>
                                                        {{-- @if ($day->id != 7)
                                                <a href="javascript:void(0)" class="btn btn-danger"
                                                    onclick="duplicate({{$day->id}})">Copy to next day</a>

                                                @endif --}}
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
                                            <div class="row">
                                                @foreach ($venue_images as $venue_image)
                                                    <div class="col-2 clone-1" id="clone-1">
                                                        <div class="fileinput fileinput-exist" data-provides="fileinput">
                                                            <div class="fileinput-new img-thumbnail"
                                                                style="width: 200px; height: 150px;">
                                                                <img src="{{ asset('images/venue/' . $venue_image->image) }} "
                                                                    style="width:80px; height:80px; float:center; margin:auto"
                                                                    alt="...">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists img-thumbnail"
                                                                style="max-width: 200px; max-height: 150px;"></div>
                                                            <div>
                                                                <a href="javascript:void(0);"
                                                                    onclick="delImage(this,{{ $venue_image->id }})"
                                                                    class="btn btn-outline-secondary">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-4 clone-1" id="clone-1">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new img-thumbnail"
                                                            style="width: 200px; height: 150px;">
                                                            <img src="{{ asset('templates/img/upload.png') }}"
                                                                style="width:80px; height:80px; float:center; margin:auto"
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
                                <input hidden value="{{ $data }}" name="data">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Panggil fungsi toogleMembership saat halaman dimuat
            toogleMembership();
        });

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
                        document.getElementById('imagePreview').innerHTML = '<img id="image" src="' + e.target.result +
                            '" style="width: 100%; height: 100%;"></img>';
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
                    id: checked,
                    venue_id: "{{ $venues->id }}"
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
                                            class="form-control">
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

        function delImage(data, id) {
            //var $ele = data.parent().parent();
            //var id= $(this).val();
            //var id= 20;
            var url = "{{ URL('api/venue') }}";
            var dltUrl = url + "/" + id + "/destroy-image";
            $.ajax({
                url: dltUrl,
                type: "DELETE",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        //$ele.fadeOut().remove();
                        data.closest('.clone-1').remove();
                    }
                }
            });
        }

        if ($('.hour1').is(':checked')) {
            $('#select1').toggle();
            $("#day1").prop('checked', true);
            document.getElementById('status1').innerHTML = "Open";
        }

        if ($('.hour2').is(':checked')) {
            $('#select2').toggle();
            $("#day2").prop('checked', true);
            document.getElementById('status2').innerHTML = "Open";
        }

        if ($('.hour3').is(':checked')) {
            $('#select3').toggle();
            $("#day3").prop('checked', true);
            document.getElementById('status3').innerHTML = "Open";
        }

        if ($('.hour4').is(':checked')) {
            $('#select4').toggle();
            $("#day4").prop('checked', true);
            document.getElementById('status4').innerHTML = "Open";
        }

        if ($('.hour5').is(':checked')) {
            $('#select5').toggle();
            $("#day5").prop('checked', true);
            document.getElementById('status5').innerHTML = "Open";
        }

        if ($('.hour6').is(':checked')) {
            $('#select6').toggle();
            $("#day6").prop('checked', true);
            document.getElementById('status6').innerHTML = "Open";
        }

        if ($('.hour7').is(':checked')) {
            $('#select7').toggle();
            $("#day7").prop('checked', true);
            document.getElementById('status7').innerHTML = "Open";
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
        let map;
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

            var map = new google.maps.Map(mapElement2, mapOptions1);

            google.maps.event.addListener(map, 'click', function(e) {
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
                marker.setMap(map);
            });

            $.ajax({
                url: "{{ url('api/venue/get-location') }}?id={{ $venues->id }}",
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

            // Variabel untuk menyimpan batas kordinat
            bounds = new google.maps.LatLngBounds();


            document
                .getElementById("get-location")
                .addEventListener("click", function() {
                    getLocation(map);
                });
        }

        function getLocation(map) {
            // Geolokasi / lokasi sendiri
            console.log('sampai sini');
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
