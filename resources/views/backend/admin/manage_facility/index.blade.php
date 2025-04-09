@extends('layouts.admin.home')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Fasilitas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">List Data Fasilitas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    @include('backend.admin.manage_facility.create')
    @include('backend.admin.manage_facility.edit')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data Fasilitas  </h3>

                            <a style="float:right; margin-left:200px;" href="javascript:void(0)"
                                onclick="$('#facility-create').toggle(500);$('#facility-edit').hide(500);">
                                <button class="btn btn-success" type="button">Tambah Data</button>
                            </a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped dataTables-facility">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Icon</th>
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

{!! Form::open(['method'=>'DELETE','route'=>['admin.facility.destroy',0],
'style'=>'display.none','id'=>'deleted_facility'])!!}
{!! Form::close() !!}

@endsection

@section('script')
<script>
    function edit(id, name, icon) {
        if ($('#facility-edit').is(":visible")) {
            $('#facility-edit').hide('500');
        } else {
            $('#facility-edit').show('500');
            $('#e_name').val(name);
            $('#e_icon').val(icon);
            $('#facility-update').attr('action', "{{route('admin.facility.index')}}/" + id);
        }
        $('#create').show('500');
    }

    $(document).ready(function () {
        $('.dataTables-facility').DataTable({

            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/facility')}}?data=all",
                dataSrc: ''
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'icon'
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
                        `,'` + full.name + `','` + full.icon +
                        `')" href="javascript::void(0)"><i class="far fa-edit"></i> Edit</a>` +

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
                    $('#deleted_facility').attr('action', "{{route('admin.facility.index')}}/" + id);
                    $('#deleted_facility').submit();
                } else {
                    swal("Batal", "Anda batal menghapus data", "error");
                }
            });
    }
</script>
@endsection
