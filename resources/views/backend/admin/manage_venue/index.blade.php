@extends('layouts.admin.home')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lapangan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Lapangan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
        @include('backend.admin.manage_venue.reject')
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data Lapangan yang Perlu Konfirmasi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped dataTables-venue-1" id="table-2">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Nama Lapangan</th>
                                    <th style="width: 15%">Pemilik</th>
                                    <th style="width: 25%">Alamat</th>
                                    <th style="width: 20%">Tanggal</th>
                                    <th style="width: 25%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width: 15%">Nama Lapangan</th>
                                    <th style="width: 15%">Pemilik</th>
                                    <th style="width: 25%">Alamat</th>
                                    <th style="width: 20%">Tanggal</th>
                                    <th style="width: 25%">Action</th>
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


{!! Form::open(['method'=>'PATCH', 'route' => ['admin.venue.confirm', 0], 'style' =>
'display:none','id'=>'confirm']) !!}
{!! Form::close() !!}


@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.dataTables-venue-1').DataTable({

            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/venue')}}?data=all&&status=0",
                dataSrc: ''
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'owner'
                },
                {
                    data: 'address'
                },
                {
                    data: 'date'
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
                        ` <a class="btn btn-icon btn-sm btn-light" href="/admin/venue/` +
                        data + `/show-index"><i class="fa fa-info"></i> View</a>` +

                        ` <a class="btn btn-icon btn-sm btn-success" onclick="confirm(` +
                        data +
                        `)" href="javascript:void(0)"><i class="fa fa-check"></i> Konfirmasi</a>` +

                        ` <a class="btn btn-icon btn-sm btn-danger" onclick="reject(` +
                        data +
                        `)" href="javascript:void(0)"><i class="fa fa-times"></i> Tolak</a>` +
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

    function confirm(id) {
        swal({
                title: "Apakah kamu yakin?",
                // text: "Venue yang telah dikonfirmasi akan dibebaskan untuk beroperasi pada aplikasi ini",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5cc744",
                confirmButtonText: "Ya, konfirmasi!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false


            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Konfirmasi!", "success");
                    $('#confirm').attr('action', "/admin/venue/" + id + "/confirm");
                    $('#confirm').submit();
                } else {
                    swal("Batal", "error");
                }
            });
    }

    function reject1(id) {
        console.log(id);
        swal({
                title: "Apakah kamu yakin?",
                // text: "Permohonan venue ini akan ditolak dan pemilik venue akan diminta untuk melengkapi datanya kembali",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Tolak!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Ditolak!",
                        "success");
                    $('#reject').attr('action', "/admin/venue/" + id + "/reject");
                    $('#reject').submit();
                } else {
                    swal("Batal", "error");
                }
            });
    }
    function reject(id) {
        $('#reject-venue').toggle();
        $('#venue_id').val(id).change();
    }
</script>
@endsection
