@extends('layouts.owner.home')

@section('css')

<!-- BS Stepper -->
<link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/bs-stepper/css/bs-stepper.min.css') }}">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="{{ asset('templates/css/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-12 col-lg-12 animated fadeInRight">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Lapangan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('owner.venue.index') }}">Kelola Lapangan</a>
                        <li class="breadcrumb-item"><a href="{{ route('owner.venue.show', $fields->Venue->id) }}">Detail
                                Lapangan</a>
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
            {{ Form::open(array('method'=>'PATCH', 'url' => route('owner.field.update', $fields->id), 'files' => true )) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Informasi Lapangan</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-row">
                                                <div class="form-group col-md-5" style="margin-right:50px;">
                                                    <label for="field_name">Nama Lapangan</label> <br>
                                                    <input name="field_name" oninput="this.className = ''" type="text"
                                                        class="form-control-sm validate" id="field_name"
                                                        placeholder="Inputkan nama lapagan" style="width:100%;" value="{{$fields->name}}">
                                                    @error('field_name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-5" style="margin-right:50px;">
                                                    <label for="field_type">Tipe Lapangan</label><br>
                                                    <select name="field_type" id="s_field_type_create" class="form-control form-control-sm
                                                        selectpicker validate" data-live-search="true"
                                                        onchange="this.className = ''"
                                                        style="max-height: 10px !important;">
                                                        @foreach($field_type as $type)
                                                        @if ($type->id == $fields->field_type_id)
                                                        <option value="{{$type->id}}" selected>{{$type->name}}</option>
                                                        @else
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @error('field_type')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label>Gambar Lapangan</label><br>
                                                    <div class="fileinput fileinput-exists" data-provides="fileinput">
                                                        <span class="btn btn-outline-dark btn-file"><span
                                                                class="fileinput-new">Upload Gambar</span>
                                                            <span class="fileinput-exists">Change</span><input type="file"
                                                                id="field_image" name="field_image" value="{{$fields->image}}" file="{{$fields->image}}" /></span>
                                                            <span class="fileinput-filename">
                                                                {{$fields->image}}
                                                            </span>
                                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                                            style="float: none">×</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{asset('templatesAdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('templatesAdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    document.getElementById("s_field_type_create").oninput = "this.className = ''";

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("field-create").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByClassName("validate");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
@endsection
