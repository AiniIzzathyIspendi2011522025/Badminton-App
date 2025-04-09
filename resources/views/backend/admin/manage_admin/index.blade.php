@extends('layouts.admin.home')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">List Data Admin</li>
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
                            <h3 class="card-title">List Data Admin</h3>
                            <a style="float:right; margin-left:200px;" href="{{ route('admin.admin.create') }}">
                                <button class="btn btn-block btn-success">Tambah Data</button>
                            </a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTables-admin">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->first_name . $admin->last_name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->handphone }}</td>
                                            <td>
                                                <a class="btn btn-icon icon-left btn-info btn-sm"
                                                    href="{{ route('admin.admin.edit', $admin->id) }}">
                                                    <i class="far fa-edit"></i>
                                                    Edit</a>
                                                {{-- <a href="/admin/admin/{{ $admin->id }}" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                    Delete
                                                </a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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


    {{-- {!! Form::open([
        'method' => 'DELETE',
        'route' => ['admin.admin.destroy', 0],
        'style' => 'display.none',
        'id' => 'deleted_admin',
    ]) !!}
    {!! Form::close() !!}
    {!! Form::open([
        'method' => 'GET',
        'route' => ['admin.admin.edit', 0],
        'style' => 'display.none',
        'id' => 'edit_admin',
    ]) !!}
    {!! Form::close() !!} --}}
@endsection

@section('script')
    {{-- <script>
    $(document).ready(function () {
        $('.dataTables-admin').DataTable({

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
                url: "{{url('api/admin')}}?data=all",
                dataSrc: ''
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'handphone'
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
                        ` <a class="btn btn-icon icon-left btn-info btn-sm" onclick="edit(` +
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

    function confirmdelete(id) {
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
            function (isConfirm) {
                if (isConfirm) {
                    swal("Data Terhapus!", "Data tersebut telah terhapus", "success");
                    $('#deleted_admin').attr('action', "{{route('admin.admin.index')}}/" + id);
                    $('#deleted_admin').submit();
                } else {
                    swal("Batal", "Anda batal menghapus data", "error");
                }
            });
    }


    function edit(id) {
        $('#edit_admin').attr('action', "{{route('admin.admin.index')}}/" + id + "/edit");
        $('#edit_admin').submit();
    }
</script> --}}
@endsection
