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
                    <h1>History Booking</h1>
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
                            <h3 class="card-title">History Transaksi Booking Lapangan
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTables-booking">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Venue</th>
                                        <th>Lapangan</th>
                                        <th>Nama Penyewa</th>
                                        <th>Jadwal</th>
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
                        data: 'name'
                    },
                    {
                        data: 'time'
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
                        return `` +

                            `<a type="button" style="margin-left:5px;" class="btn btn-icon btn-sm btn-light" onclick="show(` +
                            data + `)"
                            href="/owner/history/` + data + `/show"><i class="fa fa-info"></i> Detail</a>` +
                            ``;
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
    </script>
@endsection
