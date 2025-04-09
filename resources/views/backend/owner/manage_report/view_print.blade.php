@extends('layouts.owner.home')

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('templatesAdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        @media print {
            @page {
                size: landscape
            }
        }

        @page {
            size: A4 landscape;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            font-weight: bold;
            text-align: center;
            color: rgb(3, 10, 103);
            background-color: rgb(255, 252, 252);
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
            text-align: center;
            background-color: white;
        }

        .text-center {
            text-align: center;
        }
    </style>
    <style type="text/css" media="print">
        .page {
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        }
    </style>
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
                        <li class="breadcrumb-item"><a href="{{ route('owner.report.index') }}">Laporan</a></li>
                        <li class="breadcrumb-item active">Cetak Laporan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            {{ Form::open(['method' => 'POST', 'url' => route('owner.report.print')]) }}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cetak Laporan Transaksi
                    </h3>
                </div>
                <div class="card-body">
                    @foreach ($venues as $venue)
                        <div class="row">
                            <div class="col-12">
                                <p><strong>Nama Venue : {{ $venue->name }}</strong></p>
                                <p><strong>Transaksi pada : {{ $date[0] }} - {{ $date[1] }}</strong></p>
                            </div>
                        </div>
                        <?php
                        $fields = App\Models\Field::where('venue_id', $venue->id)->get();
                        $field_id = collect([]);
                        foreach ($fields as $field) {
                            $field_id->push($field->id);
                        }
                        
                        $rents = App\Models\Rent::whereIn('field_id', $field_id)
                            ->where(DB::raw('date_format(created_at, "%m/%d/%Y")'), '>=', $date[0])
                            ->where(DB::raw('date_format(created_at, "%m/%d/%Y")'), '<=', $date[1])
                            ->where('status', 4)
                            ->get();
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal booking</th>
                                    <th>Penyewa</th>
                                    <th>Lapangan</th>
                                    <th>Jam mulai - berakhir</th>
                                    <th>Durasi booking</th>
                                    <th>Metode booking</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($rents as $rent)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rent->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $rent->tenant_name }}</td>
                                        <td>{{ $rent->Field->name }}</td>
                                        <td>{{ $rent->order('asc') }} - {{ $rent->order('desc') }}</td>
                                        <td>{{ $rent->RentDetail->count() }} jam</td>
                                        <td>
                                            @if ($rent->RentPayment)
                                                Online
                                            @else
                                                Offline
                                            @endif
                                        </td>
                                        <td>{{ Helper::rupiah($rent->total_price) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="7">Total Pemasukan</th>
                                    <th>{{ Helper::rupiah($rents->sum('total_price')) }}</th>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                    <!-- <button type="submit" class="btn btn-primary"><i class='fas fa-eye' style='font-size:12px'></i> View</button> -->
                    <div class="form-group" style="display:none">
                        <label>Laporan transaksi pada venue : </label>
                        {!! Form::select('venue[]', $venue_select, $venue_id, [
                            'title' => 'Nothing Selected',
                            'class' => 'form-control
                                                                                                                                                                                                                                                                                                                    select2',
                            'data-live-search' => 'true',
                            'required' => 'required',
                            'id' => 's_day',
                            'multiple' => 'multiple',
                            'data-placeholder' => 'Select a State',
                        ]) !!}
                    </div>
                    <div class="form-group" style="display:none">
                        <label>Laporan transaksi pada tanggal :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="date_range" value="{{ $date_range }}"
                                class="form-control float-right" id="reservation" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class='fas fa-download' style='font-size:12px'></i>
                        Cetak</button>
                </div>
                {!! Form::close() !!}
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
        $(function() {
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
