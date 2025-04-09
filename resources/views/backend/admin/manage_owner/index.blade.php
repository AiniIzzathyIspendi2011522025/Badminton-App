@extends('layouts.admin.home')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Owner</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">List Data Owner</li>
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
                        <h3 class="card-title">List Data Owner  </h3>
                            <a style="float:right; margin-left:200px;" href="{{ route('admin.owner.create') }}">
                                <button class="btn btn-block btn-success">Tambah Data</button>
                            </a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped dataTables-owner">
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


{!! Form::open(['method'=>'DELETE','route'=>['admin.owner.destroy',0],
'style'=>'display.none','id'=>'deleted_owner'])!!}
{!! Form::close() !!}
{!! Form::open(['method'=>'GET','route'=>['admin.owner.edit',0], 'style'=>'display.none','id'=>'edit_owner'])!!}
{!! Form::close() !!}

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.dataTables-owner').DataTable({

            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/owner')}}?data=all",
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

    // function confirmdelete(id){
    //     Swal.fire({
    //     title: 'Are you sure?',
    //     text: "You won't be able to revert this!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire(
    //         'Deleted!',
    //         'Your file has been deleted.',
    //         'success'
    //         );
    //         $('#deleted_owner').attr('action', "{{route('admin.owner.index')}}/"+id);
    //         $('#deleted_owner').submit();
    //     }
    //     })
    // }
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
                    $('#deleted_owner').attr('action', "{{route('admin.owner.index')}}/" + id);
                    $('#deleted_owner').submit();
                } else {
                    swal("Batal", "Anda batal menghapus data", "error");
                }
            });
    }

    function edit(id) {
        $('#edit_owner').attr('action', "{{route('admin.owner.index')}}/" + id + "/edit");
        $('#edit_owner').submit();
    }
</script>
@endsection
