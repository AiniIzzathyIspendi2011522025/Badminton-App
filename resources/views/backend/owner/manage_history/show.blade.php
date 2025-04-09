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
                    <h1>Detail History Booking</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('owner.history.index') }}">History</a></li>
                        <li class="breadcrumb-item active">Detail History</li>
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
                            <h3 class="card-title">Detail History Booking Lapangan
                            </h3>
                            @if ($rents->status == 2)
                                <span style="float:right;margin-left:5px;" class="badge badge-primary">Dibooking</span>
                            @elseif ($rents->status == 1 && Carbon\Carbon::now() >= Carbon\Carbon::parse($rents->History->created_at)->addMinutes(10))
                                <span style="float:right;margin-left:5px;" class="badge badge-warning">Expired</span>
                            @elseif ($rents->status == 1)
                                <span style="float:right;margin-left:5px;" class="badge badge-default">Booking Sedang
                                    Diajukan</span>
                            @elseif ($rents->status == 3)
                                <span style="float:right;margin-left:5px;" class="badge badge-danger">Booking Ditolak</span>
                            @elseif ($rents->status == 4)
                                <span style="float:right;margin-left:5px;" class="badge badge-info">Selesai</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label><i class='fas fa-user-alt' data-toggle="tooltip" data-title="Nama Penyewa"
                                                data-placement="bottom"></i> {{ $rents->tenant_name }}</label>
                                        <br>
                                        <label><i class='fas fa-calendar-alt' data-toggle="tooltip"
                                                data-title="Tanggal Booking" data-placement="bottom"></i>
                                            {{ date('d-m-Y', strtotime($rents->date)) }}</label>
                                        <br>
                                        <label><i class='far fa-clock' data-toggle="tooltip" data-title="Jam Booking"
                                                data-placement="bottom"></i>
                                            {{ $rents->order('asc') . '-' . $rents->order('desc') }}</label>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        @if ($rents->RentPayment)
                                            <label><i class='far fa-circle' style='font-size:15px' data-toggle="tooltip"
                                                    data-title="Metode Booking" data-placement="bottom"></i>
                                                Online
                                            </label>
                                            <br>
                                            <label><i class='far fa-credit-card' data-toggle="tooltip"
                                                    data-title="Metode Pembayaran" data-placement="bottom"></i>
                                                {{ $rents->RentPayment->PaymentMethodDetail->PaymentMethod->name }}</label>
                                            <br>
                                            <label><i class='fas fa-cart-arrow-down' data-toggle="tooltip"
                                                    data-title="Jenis Pembayaran" data-placement="bottom"></i>
                                                @if (!$rents->dp)
                                                    Pembayaran Lunas
                                                @else
                                                    Pembayaran dengan DP
                                                @endif
                                            </label>
                                            <br>
                                            <label><i class='fas fa-tasks' data-toggle="tooltip" data-title="Status Booking"
                                                    data-placement="bottom"></i>
                                                @if ($rents->status == 1)
                                                    Sedang diajukan
                                                @elseif($rents->status == 2)
                                                    Booking diterima
                                                @elseif ($rents->status == 3)
                                                    Booking ditolak
                                                @elseif ($rents->status == 4)
                                                    Booking Selesai
                                                @endif
                                            </label>
                                        @elseif ($rents->status == 1 && Carbon\Carbon::now() >= Carbon\Carbon::parse($rents->History->created_at)->addMinutes(10))
                                            <label><i class='far fa-circle' style='font-size:15px' data-toggle="tooltip"
                                                    data-title="Metode Booking" data-placement="bottom"></i>
                                                Online
                                            </label>
                                            <br>
                                            <label><i class='fas fa-cart-arrow-down' data-toggle="tooltip"
                                                    data-title="Jenis Pembayaran" data-placement="bottom"></i>
                                                @if (!$rents->dp)
                                                    Pembayaran Lunas
                                                @else
                                                    Pembayaran dengan DP
                                                @endif
                                            </label>
                                            <br>
                                            <label><i class='fas fa-tasks' data-toggle="tooltip" data-title="Status Booking"
                                                    data-placement="bottom"></i>

                                                @if ($rents->status == 1 && Carbon\Carbon::now() >= Carbon\Carbon::parse($rents->History->created_at)->addMinutes(10))
                                                    Expired
                                                @endif
                                            @elseif (!$rents->RentPayment)
                                                <label><i class='far fa-circle' style='font-size:15px' data-toggle="tooltip"
                                                        data-title="Metode Booking" data-placement="bottom"></i>
                                                    Offline
                                                </label>
                                                <br>
                                                <label><i class='fas fa-tasks' data-toggle="tooltip"
                                                        data-title="Status Booking" data-placement="bottom"></i>
                                                    @if ($rents->status == 1)
                                                        Sedang diajukan
                                                    @elseif($rents->status == 2)
                                                        Booking diterima
                                                    @elseif ($rents->status == 3)
                                                        Booking ditolak
                                                    @elseif ($rents->status == 4)
                                                        Booking Selesai
                                                    @endif
                                                </label>
                                                <br>
                                        @endif



                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    @if ($rents->RentPayment)
                                        <div class="form-group">
                                            <label>Bukti Pembayaran </label><br>
                                            <img src="{{ asset('images/payment/' . $rents->RentPayment->payment) }}"
                                                alt="" style="width:300px; height:200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- select -->
                                    <h2></i>Kode Booking : {{ $rents->token }}</h2>
                                    <div class="form-group">
                                        <label>Detail Booking ( {{ $rents->Field->name }} -
                                            {{ $rents->Field->Venue->name }} )</label>
                                        <div class="form-group">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>Jam</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($rents->RentDetail as $rentDetail)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}.</td>
                                                            <td>{{ $rentDetail->OpeningHourDetail->OpeningHour->Hour->hour }}
                                                            </td>
                                                            <td>{{ Helper::rupiah($rentDetail->OpeningHourDetail->price) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="2">subtotal Harga</th>
                                                        <th>{{ Helper::rupiah($rents->total_price + $rents->diskon) }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">Diskon ({{ $rents->kode_promo }})</th>
                                                        <th>-{{ Helper::rupiah($rents->diskon) }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">Total Harga</th>
                                                        <th>{{ Helper::rupiah($rents->total_price) }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
