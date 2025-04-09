@extends('layouts.admin.home')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Customer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">List Data Customer</li>
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
                        <h3 class="card-title">List Data Admin   </h3>
                            <a style="float:right; margin-left:200px;" href="{{ route('admin.customer.create') }}">
                                <button class="btn btn-block btn-success">Tambah Data</button>
                            </a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped dataTables-customer">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
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




{!! Form::open(['method'=>'DELETE','route'=>['admin.customer.destroy',0],
'style'=>'display.none','id'=>'deleted_customer'])!!}
{!! Form::close() !!}
{!! Form::open(['method'=>'GET','route'=>['admin.customer.edit',0], 'style'=>'display.none','id'=>'edit_customer'])!!}
{!! Form::close() !!}

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.dataTables-customer').DataTable({

            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/customer')}}?data=all",
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
                    $('#deleted_customer').attr('action', "{{route('admin.customer.index')}}/" + id);
                    $('#deleted_customer').submit();
                } else {
                    swal("Batal", "Anda batal menghapus data", "error");
                }
            });
    }

    function edit(id) {
        $('#edit_customer').attr('action', "{{route('admin.customer.index')}}/" + id + "/edit");
        $('#edit_customer').submit();
    }
</script>
@endsection
