@extends('layouts.owner.home')

@section('css')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('templatesAdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cetak Laporan Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cetak Laporan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                {{ Form::open(array('method'=>'POST', 'url' => route('owner.report.preview'))) }}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cetak Laporan Transaksi
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Laporan transaksi pada venue : </label>
                            <select class="select2" name="venue[]" multiple="multiple" data-placeholder="Select a State"
                                style="width: 100%;" required>
                                @foreach ($venues as $venue)
                                    @if ($venue->status == 1)
                                        <option value="{{$venue->id}}">{{$venue->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Laporan transaksi pada tanggal :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="date_range" class="form-control float-right" id="reservation" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- <button type="submit" class="btn btn-primary"><i class='fas fa-eye' style='font-size:12px'></i> View</button> -->
                        <button type="submit" class="btn btn-primary"><i class='fas fa-download' style='font-size:12px'></i> View</button>

                    </div>
                    {!! Form::close() !!}
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</section>

@endsection
@section('script')
<!-- date-range-picker -->
<script src="{{ asset('templatesAdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('templatesAdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('templatesAdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //Date range picker
        $('#reservation').daterangepicker()
    })
</script>
@endsection