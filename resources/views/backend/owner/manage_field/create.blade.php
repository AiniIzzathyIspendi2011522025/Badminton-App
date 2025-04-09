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
    <div class="col-md-12 col-lg-12 animated fadeInRight">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Lapangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('owner.venue.index') }}">Kelola Venue</a>
                            <li class="breadcrumb-item"><a href="{{ route('owner.venue.show', $venue->id) }}">Detail
                                    Venue</a>
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
                                    {{ Form::open(['method' => 'POST', 'url' => route('owner.venue.field.store', $venue->id), 'id' => 'form', 'files' => true, 'class' => 'wizard-big']) }}

                                    <h1>Informasi Lapangan</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="form-group">
                                                    <label for="field_name">Nama Lapangan</label> <br>
                                                    <input name="field_name" oninput="this.className = ''" type="text"
                                                        class="form-control-sm validate" id="field_name"
                                                        placeholder="Inputkan nama lapagan" style="width:100%;" required>
                                                    @error('field_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="field_type">Tipe Lapangan</label><br>
                                                    <select name="field_type" id="s_field_type_create"
                                                        class="form-control
                                                            selectpicker"
                                                        data-live-search="true" onchange="this.className = ''"
                                                        style="max-height: 10px !important;">
                                                        @foreach ($field_type as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('field_type')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Gambar Lapangan</label><br>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn btn-outline-dark btn-file"><span
                                                                class="fileinput-new">Upload Gambar Lapangan</span>
                                                            <span class="fileinput-exists">Change</span><input required
                                                                type="file" id="field_image" name="field_image"
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

                                    </fieldset>
                                    <h1>Jadwal</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="form-group">
                                                <label>Pilih Hari</label>
                                                {!! Form::select('day', $day, null, [
                                                    'title' => 'Nothing Selected',
                                                    'class' => 'form-control
                                                                                                                                            selectpicker',
                                                    'data-live-search' => 'true',
                                                    'required' => 'required',
                                                    'id' => 's_day',
                                                    'multiple' => 'multiple',
                                                    'onchange' => 'selectChange()',
                                                ]) !!}
                                                @error('day')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div id="row-selectgroup">
                                            </div>
                                        </div>
                                    </fieldset>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection

@section('script')
    <!-- Steps -->
    <script src="{{ asset('templatesAdminLTE/plugins/steps/jquery.steps.min.js') }}"></script>

    <!-- Jquery Validate -->
    <script src="{{ asset('templatesAdminLTE/plugins/steps/jquery.validate.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templatesAdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('templates/js/stisla.js') }}"></script>
    <script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

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

        var id = [
            [],
            [],
            [],
            [],
            [],
            [],
            []
        ];
        var oldSelect = [];
        var terserah = 1;

        function selectChange() {
            let data = $('#s_day').val();
            showData(data);

        }

        var checkboxes = [];
        $(':checkbox').on('change', function(e) {
            console.log('checkboxes');
            if (this.checked) {
                checkboxes[$(this).val()] = $(this).val();
                alert(this.value);
            }
        });

        function submit_hour() {
            let select = $('#s_day').val();
            var row = $(`<input type="text" name="detail_price[][]" value="">`);
            $('#field-create').append(row);

        }

        function showData(select) {
            var removeSelect = $.grep(oldSelect, function(value) {
                return $.inArray(value, select) < 0;
            })

            var containsAll = oldSelect.every(element => {
                return select.indexOf(element) !== -1;
            });

            var filter = oldSelect.filter(ai => select.includes(ai));

            if (removeSelect.length > 0) {
                for (x = 0; x < removeSelect.length; x++) {
                    $('.remove-select' + removeSelect[x]).remove();
                }
            }

            var y = 0;
            for (x = 0; x < select.length; x++) {
                let isFounded = filter.some(ai => select[x].includes(ai));
                if (!isFounded) {
                    if (select.length > 1) {
                        var div = $(`<div class="form-row col-md-12 selectgroup remove-select` + select[x] +
                            `" id="selectgroup` + x + `"></div>`);

                        $('.remove-select' + select[x - 1]).after(div);

                        var div = $(`<div class="form-group col-md-12">
                                    <label id="label-select` + x + `"></label>
                                </div>
                                <div class="form-group row select` + x + `" id="select` + x + `">
                                <div class="form-group col-md-12">
                                    <input name="price[` + select[x] + `][]" type="text" class="form-control form-control-sm" id="c_price" placeholder="Input your venues price" style="heigth:500px" required>
                                    <input name="select" type="text" class="form-control form-control-sm" id="select` +
                            select[x] + `" placeholder="Input your venues price" style="heigth:500px" hidden>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="selectgroup selectgroup-pills pills` + x + `" id="selectgroup-pills` +
                            x + `">
                                    </div>
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <a href="javascript:void(0)" onClick="cloneForm(` + x + `)" class="btn btn-primary btn-outline">Tambah</a>
                                </div>`);
                        $('#selectgroup' + x).append(div);
                        ajaxHour(select[x], x, y);
                        ajaxDay(select[x], x);
                    } else {
                        var div = $(`<div class="form-row col-md-12 selectgroup remove-select` + select[x] +
                            `" id="selectgroup` + x + `"></div>`);

                        $('#row-selectgroup').append(div);

                        var div = $(`<div class="form-group col-md-12">
                                    <label id="label-select` + x + `"></label>
                                </div>
                                <div class="form-group row select` + x + `" id="select` + x + `">
                                <div class="form-group col-md-12">
                                    <input name="price[` + select[x] + `][]" type="text" class="form-control form-control-sm price" id="c_price" placeholder="Input your venues price" style="heigth:500px" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="selectgroup selectgroup-pills pills` + x + `" id="selectgroup-pills` +
                            x + `">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                <a href="javascript:;" onclick="delClone(this)"
                                            class="btn btn-outline-secondary" >
                                            Delete
                                        </a>
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <a href="javascript:void(0)" onClick="cloneForm(` + x + `)" class="btn btn-primary btn-outline">Tambah</a>
                                </div>`);
                        $('#selectgroup' + x).append(div);
                        ajaxHour(select[x], x, y);
                        ajaxDay(select[x], x);
                    }
                    var selectLength = $('.selectgroup-pills').length;
                    var coba = select[x];
                    console.log(selectLength);
                }
                y++;

                oldSelect = select;
                terserah++;
            }
        }

        function cloneForm(x) {
            let select = $('#s_day').val();
            var length = $('.pills' + x + ':last .hour' + x).length;

            var clone = 1;
            for (var i = 1; i <= length; i++) {
                if ($('.pills' + x + ':last #hour' + i).prop("disabled") == false) {
                    if ($('.pills' + x + ':last #hour' + i).prop("checked") == false) {
                        clone = 2;
                    }
                }
                if ($('.pills' + x + ':last #hour' + i).prop("checked") == true) {
                    id[x].push(i);
                }
            }
            if (clone == 2) {
                $("#select" + x)
                    .eq(0)
                    .clone()
                    .find(".price").val("").end() // ***
                    .show()
                    .insertAfter(".select" + x + ":last");

                let selectCheck = $('#s_day').val();
                for (var z = 0; z < selectCheck.length; z++) {
                    var selectLength = $('.pills' + z).length;
                    for (var i = 0; i < selectLength; i++) {
                        var index = $('.pills' + z).eq(i).index('.pills' + z);
                        $('.pills' + z)
                            .eq(i)
                            .find('input')
                            .attr('name', 'detail[' + selectCheck[z] + '][' + index + '][]')
                            .end();
                    }
                }
                duplicate(id, x);
            }
        }

        function duplicate(id, x) {
            for (var i = 0; i < id[x].length; i++) {
                $('.pills' + x + ':last #hour' + id[x][i]).prop("disabled", true);
                $('.pills' + x + ':last #hour' + id[x][i]).prop("checked", false);
                $('.pills' + x + ':last #span' + id[x][i]).css("background-color", "red");
                $('.pills' + x + ':last #span' + id[x][i]).css("color", "#fff");
            }
        }

        function ajaxHour(select, x, y) {
            $.ajax({
                url: "{{ url('api/venue/opening-hour') }}?venue_id={{ $venue->id }}&&day_id=" + select,
                dataType: 'json',
                cache: false,
                dataSrc: '',
                success: function(data) {
                    var hour_id = data.map(function(item) {
                        return item.hour_id;
                    });
                    var hour = data.map(function(item) {
                        return item.hour;
                    });
                    var status = data.map(function(item) {
                        return item.status;
                    });
                    var day_id = data.map(function(item) {
                        return item.day_id;
                    });

                    var length = $('.selectgroup-pills').length;
                    for (i = 0; i < data.length; i++) {
                        if (status[i] == 1) {
                            var row = $(`<label class="selectgroup-item"><input type="checkbox" id="hour` +
                                hour_id[i] + `" name="detail[this][0][]" class="selectgroup-input hour` +
                                x +
                                `" disabled> <span class="selectgroup-button" id="span` + hour_id[i] +
                                `" style="background-color:gray;color: #fff;">` + hour[i] +
                                `</span></label>`);
                        } else {
                            var row = $(`<label class="selectgroup-item hour` + x +
                                `"><input type="checkbox" id="hour` + hour_id[i] +
                                `" name="detail[this][0][]"  onchange="return checkboxes[` + hour_id[i] +
                                `]=` +
                                hour_id[i] +
                                `" class="selectgroup-input hour` + x + `" value="` + hour_id[i] +
                                `"> <span class="selectgroup-button" id="span` +
                                hour_id[i] + `">` + hour[i] + `</span></label>`);
                        }
                        $('#selectgroup-pills' + x).append(row);
                    }
                    let selectCheck = $('#s_day').val();

                    for (var z = 0; z < selectCheck.length; z++) {
                        var selectLength = $('.pills' + z).length;
                        for (var i = 0; i < selectLength; i++) {
                            var index = $('.pills' + z).eq(i).index('.pills' + z);
                            $('.pills' + z)
                                .eq(i)
                                .find('input')
                                .attr('name', 'detail[' + selectCheck[z] + '][' + index + '][]')
                                .end();

                            //y++;
                        }
                    }
                }

            });
        }

        function ajaxDay(data, x) {
            $.ajax({
                url: "{{ url('api/venue/opening-hour/day') }}?day_id=" + data,
                dataType: 'json',
                cache: false,
                dataSrc: '',
                success: function(data) {
                    $('#label-select' + x).text(data.name);
                }

            });
        }

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

        function fileValidation() {
            var fileInput = document.getElementById('field_image');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png only.');
                fileInput.value = '';
                return false;
            } else {
                //Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
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
    </script>
@endsection
