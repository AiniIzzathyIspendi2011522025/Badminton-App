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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data Lapangan yang Ditolak</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped dataTables-venue-2" id="table-2">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Nama Lapangan</th>
                                    <th style="width: 15%">Pemilik</th>
                                    <th style="width: 30%">Alamat</th>
                                    <th style="width: 20%">Tanggal</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width: 15%">Nama Lapangan</th>
                                    <th style="width: 15%">Pemilik</th>
                                    <th style="width: 30%">Alamat</th>
                                    <th style="width: 20%">Tanggal</th>
                                    <th style="width: 20%">Action</th>
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

{!! Form::open(['method'=>'GET','route'=>['admin.admin.edit',0], 'style'=>'display.none','id'=>'edit_admin'])!!}
{!! Form::close() !!}

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.dataTables-venue-2').DataTable({

            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/venue')}}?data=all&&status=2",
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
                        data + `/show2-index"><i class="fa fa-info"></i> View</a>` +
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
</script>
@endsection
