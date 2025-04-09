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
                @include('backend.owner.manage_booking.reject')
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
                        @include('backend.owner.manage_booking.edit')
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTables-booking">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Venue</th>
                                        <th>Lapangan</th>
                                        <th>Jadwal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
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

    {!! Form::open([
        'method' => 'PATCH',
        'route' => ['owner.booking.confirm', 0],
        'style' => 'display:none',
        'id' => 'confirm',
    ]) !!}
    {!! Form::close() !!}
    {!! Form::open([
        'method' => 'DELETE',
        'route' => ['owner.booking.destroy', 0],
        'style' => 'display.none',
        'id' => 'deleted_booking',
    ]) !!}
    {!! Form::close() !!}
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
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
                    url: "{{ url('api/booking') }}?data=all&owner_id=" + {{ Auth::user()->id }},
                    dataSrc: ''
                },
                columns: [{
                        data: 'date'
                    },
                    {
                        data: 'venue'
                    },
                    {
                        data: 'field'
                    },
                    {
                        data: 'time'
                    },
                    {
                        data: 'p_status'
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
                    render: function(data, type, full, meta) {
                        var base = "{{ url('/') }}"
                        if (full.history == true) {
                            if (full.status != 1 || full.expired == 1) {
                                return `` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-light" onclick="show(` +
                                    data + `)"
                            href="/owner/booking/` + data + `/show"><i class="fa fa-info"></i> Detail</a>` +
                                    ``;
                            } else {
                                return `` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-light" onclick="show(` +
                                    data + `)"
                            href="/owner/booking/` + data + `/show"><i class="fa fa-info"></i> Detail</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-success" onclick="confirm(` +
                                    data +
                                    `)" href="javascript:void(0)"><i class="fa fa-check"></i> Terima</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-danger" onclick="reject(` +
                                    data +
                                    `)" href="javascript:void(0)"><i class="fa fa-times"></i> Tolak</a>`

                                    +
                                    ``;

                            }
                        } else {
                            if (full.status != 1) {
                                return `` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-light" onclick="show(` +
                                    data + `)"
                            href="/owner/booking/` + data + `/show"><i class="fa fa-info"></i> Detail</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-danger" onclick="confirm_delete(` +
                                    data +
                                    `)" href="javascript:void(0)"><i class="fa fa-trash"></i> Hapus</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-warning" onclick="edit(` +
                                    data +
                                    `)" href="javascript:void(0)" data-toggle="modal" data-target="#modal-editbooking"><i class="fa fa-pen"></i> Edit</a>`

                                    +
                                    ``;
                            } else {
                                return `` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-light" onclick="show(` +
                                    data + `)"
                            href="/owner/booking/` + data + `/show"><i class="fa fa-info"></i> Detail</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-success" onclick="confirm(` +
                                    data +
                                    `)" href="javascript:void(0)"><i class="fa fa-check"></i> Terima</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-danger" onclick="reject(` +
                                    data +
                                    `)" href="javascript:void(0)"><i class="fa fa-times"></i> Tolak</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-danger" onclick="confirm_delete(` +
                                    data +
                                    `)" href="javascript:void(0)"><i class="fa fa-trash"></i> Hapus</a>` +

                                    `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-warning" onclick="edit(` +
                                    data +
                                    `)" href="javascript:void(0)" data-toggle="modal" data-target="#modal-editbooking"><i class="fa fa-pen"></i> Edit</a>`


                                    +
                                    ``;

                            }
                        }


                    },
                }, ],
            });
            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            $('#btn-print').on('click', function(e) {
                e.preventDefault();
                table.button(0).trigger();
            });
            $('#btn-copy').on('click', function(e) {
                e.preventDefault();
                table.button(1).trigger();
            });
            $('#btn-excel').on('click', function(e) {
                e.preventDefault();
                table.button(2).trigger();
            });
            $('#btn-csv').on('click', function(e) {
                e.preventDefault();
                table.button(3).trigger();
            });
            $('#btn-pdf').on('click', function(e) {
                e.preventDefault();
                table.button(4).trigger();
            });

        });

        function edit(id) {
            $.ajax({
                url: "{{ url('api/booking/apiEdit') }}?id=" + id,
                dataType: 'json',
                cache: false,
                dataSrc: '',

                success: function(data) {
                    console.log(data);
                    $('#e_tenant_name').val(data.tenant_name);
                    $('#e_venue').val(data.venue).change();
                    $('#e_field').val(data.field).change();
                    $('#e_date').val(data.date);
                    Editschedule(id);
                    $('#edit-booking').attr('action', "/owner/booking/" + id);
                }

            });
        }

        function Editschedule(id) {
            var venue_id = $('#e_venue').val();
            var field_id = $('#e_field').val();
            var date = $('#e_date').val();
            $.ajax({
                url: "{{ url('api/select/editSchedule') }}?venue_id=" + venue_id + "&field_id=" + field_id +
                    "&date=" + date + "&rent_id=" + id,
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
                        if (available[i] == 4) {
                            var div = `<label class="selectgroup-item">
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input"
                                                checked>
                                            <span class="selectgroup-button">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        } else if (available[i] == 2) {
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

                        $("#hour-checkbox-edit").append(div);
                    }

                    console.log(data)
                }

            });
        }

        function extend(data) {
            $.ajax({
                url: "{{ url('api/booking/extend') }}?id=" + data,
                dataType: 'json',
                cache: false,
                dataSrc: '',

                success: function(data) {
                    console.log(data);
                    console.log(data.tenant_name);
                    $('#m_tenant_name').text(data.tenant_name);
                    $('#m_venue').text(data.venue);
                    $('#m_field').text(data.field);
                    $('#m_date').text(data.date);
                }

            });
        }

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

        $('#c_venue').on('select2:select', function(e) {
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
            let base_url = "{{ URL('api/select/field') }}";
            $("#c_field").select2({
                allowClear: true,
                language: {
                    noResults: function(params) {
                        return "Tidak ada tipe room yang sesuai pada kos ini";
                    }
                },
                tokenSeparators: [',', ' '],
                ajax: {
                    url: base_url + "/" + venue,
                    dataType: "json",
                    type: "GET",
                    quietMillis: 50,
                    data: function(params) {
                        var queryParameters = {
                            term: params.term
                        }
                        return queryParameters;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
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

        $('#c_field').on('select2:select', function(e) {
            var venue_id = $('#c_venue').val();
            var field_id = $('#c_field').val();
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

        function confirm(id) {
            swal({
                    title: "Apakah permintaan booking ini diterima?",
                    text: "Booking yang diterima akan tercatat dalam transaksi",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#5cc744",
                    confirmButtonText: "Ya, terima!",
                    cancelButtonText: "Tidak, batalkan!",
                    closeOnConfirm: false,
                    closeOnCancel: false


                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("Konfirmasi!", "Booking Diterima", "success");
                        $('#confirm').attr('action', "/owner/booking/" + id + "/confirm");
                        $('#confirm').submit();
                    } else {
                        swal("Batal", "Kamu batal melakukan penerimaan booking", "error");
                    }
                });
        }

        function confirm_delete(id) {
            swal({
                    title: "Apakah kamu yakin?",
                    text: "Data ini akan terhapus total",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ff2929",
                    confirmButtonText: "Ya, Hapus Data!",
                    cancelButtonText: "Tidak, batalkan!",
                    closeOnConfirm: false,
                    closeOnCancel: false


                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("Data Terhapus!", "Data tersebut telah terhapus", "success");
                        $('#deleted_booking').attr('action', "{{ route('owner.booking.index') }}/" + id);
                        $('#deleted_booking').submit();
                    } else {
                        swal("Batal", "Anda batal menghapus data", "error");
                    }
                });
        }

        function reject1(id) {
            swal({
                    title: "Apakah permintaan booking ini ditolak?",
                    text: "Booking yang ditolak tidak dapat diproses kembali",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Tolak!",
                    cancelButtonText: "Tidak, batalkan!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("Ditolak!", "Booking ini ditolak",
                            "success");
                        $('#reject').attr('action', "/owner/booking/" + id + "/reject");
                        $('#reject').submit();
                    } else {
                        swal("Batal", "Kamu batal melakukan penolakan booking", "error");
                    }
                });
        }

        function reject(id) {
            $('#reject-booking').toggle();
            $('#rent_id').val(id);
        }
    </script>
@endsection
