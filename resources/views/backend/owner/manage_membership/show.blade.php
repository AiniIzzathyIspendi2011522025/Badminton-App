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
                    <h1>Detail Membership</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('owner.membership.owner') }}">Membership</a></li>
                        <li class="breadcrumb-item active">Detail membership</li>
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
                            <h3 class="card-title">Detail Membership
                            </h3>
                            @if ($membership->membership_status == 2)
                                <a href="/owner/membership/{{ $membership->id }}/reject" class="btn btn-danger"
                                    style="float:right;margin-left:5px;">Tolak</a>
                                <a href="/owner/membership/{{ $membership->id }}/confirm" class="btn btn-success"
                                    style="float:right;margin-left:200px;">Terima</a>
                            @elseif ($membership->membership_status == 1)
                                <span style="float:right;margin-left:5px;" class="badge badge-success">Aktif</span>
                            @elseif ($membership->membership_status == 0)
                                <span style="float:right;margin-left:5px;" class="badge badge-danger">Tidak Aktif</span>
                            @endif

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label><i class='fas fa-user-alt' data-toggle="tooltip" data-title="Nama Penyewa"
                                                data-placement="bottom"></i>
                                            {{ $membership->user->first_name }} {{ $membership->user->last_name }}
                                        </label>
                                        <br>
                                        <label><i class='fas fa-clock' data-toggle="tooltip" data-title="Nama Penyewa"
                                                data-placement="bottom"></i>
                                            Total Membership: {{ $membership->count_month }} Bulan
                                        </label>
                                        <br>
                                        <label>
                                            <i class='fas fa-calendar-alt' data-toggle="tooltip"
                                                data-title="Tanggal Booking" data-placement="bottom"></i>
                                            Mulai: {{ date('d-m-Y', strtotime($membership->start_date)) }}</label>
                                        <br>
                                        <label><i class='fas fa-calendar-alt' data-toggle="tooltip"
                                                data-title="Tanggal Booking" data-placement="bottom"></i>
                                            Berakhir: {{ date('d-m-Y', strtotime($membership->end_date)) }}</label>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    @if ($membership->payment)
                                        <div class="form-group">
                                            <label>Bukti Pembayaran </label><br>
                                            <img src="{{ asset('images/payment/' . $membership->payment) }}" alt=""
                                                style="width:300px; height:200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label class="ml-4">Detail Membership ( {{ $membership->user->first_name }}
                                        {{ $membership->user->last_name }} -
                                        {{ $membership->venue->name }} )</label>
                                    <div class="form-group">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Venue</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $membership->user->first_name }}
                                                        {{ $membership->user->last_name }}</td>
                                                    <td>{{ $membership->venue->name }}</td>
                                                    <td>{{ Helper::rupiah($membership->venue->membership_price) }}</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total Harga</th>
                                                    <th>{{ Helper::rupiah(35000) }}</th>
                                                </tr>
                                            </tfoot>
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
