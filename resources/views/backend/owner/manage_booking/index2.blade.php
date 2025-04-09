@extends('layouts.owner.home')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('templates/css/custom/selectgroup.css') }}">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kelola Booking</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Kelola Booking</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Transaksi Booking Lapangan
                        </h3>
                        <button style="float:right;margin-left:200px;" type="button" class="btn btn-success"
                            data-toggle="modal" data-target="#modal-booking">Tambah Booking Offline
                            </button>
                    </div>
                    <!-- /.card-header -->
                    @include('backend.owner.manage_booking.create')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-3">
                                        <a href="">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Permohonan Booking Baru</span>
                                                    <span class="info-box-number text-center text-muted mb-0">2300</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <a href="">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Booking Aktif</span>
                                                    <span class="info-box-number text-center text-muted mb-0">2000</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <a href="">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Booking Selesai <small>Hari Ini</small> </span>
                                                    <span class="info-box-number text-center text-muted mb-0">20</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <a href="">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total Booking</span>
                                                    <span class="info-box-number text-center text-muted mb-0">20</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Data Booking</h4>
                                        <hr>
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="../../dist/img/user7-128x128.jpg" alt="User">
                                                <span class="username">
                                                    Sarah Ross
                                                    <p style="float:right">
                                                        <a href="#" class="btn btn-sm btn-success">Add files</a>
                                                        <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                                                    </p>
                                                </span>
                                                <span class="description">Sent you a message - 3 days ago</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore.
                                            </p>
                                            <p>
                                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>
                                                    Demo File 2</a>
                                            </p>

                                        </div>
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="../../dist/img/user7-128x128.jpg" alt="User">
                                                <span class="username">
                                                    Sarah Ross
                                                    <p style="float:right">
                                                        <a href="#" class="btn btn-sm btn-success">Add files</a>
                                                        <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                                                    </p>
                                                </span>
                                                <span class="description">Sent you a message - 3 days ago</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore.
                                            </p>
                                            <p>
                                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>
                                                    Demo File 2</a>
                                            </p>

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
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</section>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.dataTables-booking').DataTable({

            responsive: true,
            searchDelay: 500,
            processing: true,
            buttons: [{
                    extend: 'print',
                    className: 'btn-inverse',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                'copy',
                {
                    extend: 'excel',
                    className: 'btn-inverse',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                'csvHtml5',
                {
                    extend: 'pdf',
                    className: 'btn-inverse',
                    exportOptions: {
                        columns: [0, 1]
                    }
                }
            ],
            // serverSide: true,
            ajax: {
                url: "{{url('api/booking')}}?data=all",
                dataSrc: ''
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'venue'
                },
                {
                    data: 'field'
                },
                {
                    data: 'date'
                },
                {
                    data: 'total_price'
                },
                {
                    data: 'total_price'
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
                        ` <a class="btn btn-icon icon-left btn-success btn-sm" onclick="edit(` +
                        data +
                        `)" href="javascript::void(0)"><i class="far fa-edit"></i> Edit</a>` +

                        ` <a class="btn btn-icon icon-left btn-danger btn-sm" onclick="confirmdelete(` +
                        data +
                        `)" href="javascript::void(0)"><i class="fas fa-trash"></i> Hapus</a>` +
                        ``;
                },
            }, ],
        });
        table.on('order.dt search.dt', function () {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#btn-print').on('click', function (e) {
            e.preventDefault();
            table.button(0).trigger();
        });
        $('#btn-copy').on('click', function (e) {
            e.preventDefault();
            table.button(1).trigger();
        });
        $('#btn-excel').on('click', function (e) {
            e.preventDefault();
            table.button(2).trigger();
        });
        $('#btn-csv').on('click', function (e) {
            e.preventDefault();
            table.button(3).trigger();
        });
        $('#btn-pdf').on('click', function (e) {
            e.preventDefault();
            table.button(4).trigger();
        });

    });

    $('#c_field').prop("disabled", true);
    $('#c_venue').prop("disabled", true);

    $(".myselect2").select2({
        width: '100%',
        allowClear: true
    });
    $('.myselect2').val(0).change();

    function dateChange() {
        $('#c_venue').prop("disabled", false);
        $('.myselect2').val(0).change();
        $(".selectgroup-item").remove();
    }

    $('#c_venue').on('select2:select', function (e) {
        let venue = $('#c_venue').val();
        if (venue) {
            $('#c_field').val(0).change();
            $(".selectgroup-item").remove();
            fethDataField(venue);
            $('#c_field').prop("disabled", false);
        } else {
            $('#c_field').prop("disabled", true);
        }
    });

    function fethDataField(venue) {
        let base_url = "{{URL('api/select/field')}}";
        $("#c_field").select2({
            allowClear: true,
            language: {
                noResults: function (params) {
                    return "Tidak ada tipe room yang sesuai pada kos ini";
                }
            },
            tokenSeparators: [',', ' '],
            ajax: {
                url: base_url + "/" + venue,
                dataType: "json",
                type: "GET",
                quietMillis: 50,
                data: function (params) {
                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    }

    $('#c_field').on('select2:select', function (e) {
        var venue_id = $('#c_venue').val();
        var field_id = $('#c_field').val();
        var date = $('#c_date').val();
        $.ajax({
            url: "{{url('api/select/schedule')}}?venue_id=" + venue_id + "&field_id=" + field_id +
                "&date=" + date,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var detail_id = data.map(function (item) {
                    return item.detail_id;
                });
                var price = data.map(function (item) {
                    return item.price;
                });
                var hour = data.map(function (item) {
                    return item.hour;
                });
                var available = data.map(function (item) {
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
                    } else {
                        var div = `<label class="selectgroup-item">
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input"
                                                >
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
</script>
@endsection
