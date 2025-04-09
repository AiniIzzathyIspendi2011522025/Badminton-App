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
                        <h3 class="card-title">List Data Lapangan Aktif </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped dataTables-venue-3" id="table-2">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Nama Venue</th>
                                    <th style="width: 15%">Pemilik</th>
                                    <th style="width: 25%">Alamat</th>
                                    <th style="width: 20%">Tanggal</th>
                                    <th style="width: 25%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width: 15%">Nama Venue</th>
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

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.dataTables-venue-3').DataTable({

            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/venue')}}?data=all&&status=1",
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
                        data + `/show1-index"><i class="fa fa-info"></i> View</a>` +
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
