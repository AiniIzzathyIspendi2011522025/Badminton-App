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
                    <h1>Detail Booking</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('owner.booking.index') }}">Booking</a></li>
                        <li class="breadcrumb-item active">Detail Booking</li>
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
                            <h3 class="card-title">Detail Booking Lapangan
                            </h3>
                            @if ($rents->status == 2)
                                <a type="button" style="float:right;margin-left:5px;" class="btn btn-success"
                                    href="/booking/{{ $rents->id }}/cetak">
                                    Cetak
                                </a>
                                <a type="button" style="float:right;margin-left:5px;" class="btn btn-success"
                                    onclick="finish({{ $rents->id }})" href="javascript:void(0)">
                                    Booking Selesai
                                </a>
                                <a type="button" style="float:right;margin-left:5px;" class="btn btn-info"
                                    onclick="extend(`+data+`)" data-toggle="modal" data-target="#modal-extend">
                                    Perpanjang Booking
                                </a>
                                <a type="button" style="float:right;margin-left:200px;" class="btn btn-danger"
                                    onclick="extend(`+data+`)" data-toggle="modal" data-target="#modal-cancel">
                                    Batalkan Booking
                                </a>
                            @elseif ($rents->status == 1)
                                <span style="float:right;margin-left:5px;" class="badge badge-success">Booking Sedang
                                    Diajukan</span>
                            @elseif ($rents->status == 3)
                                <span style="float:right;margin-left:5px;" class="badge badge-danger">Booking Ditolak</span>
                            @elseif ($rents->status == 4)
                                <span style="float:right;margin-left:5px;" class="badge badge-info">Selesai</span>
                            @endif

                        </div>
                        <!-- /.card-header -->
                        @include('backend.owner.manage_booking.cancel')
                        @include('backend.owner.manage_booking.extend')
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
                                        @if ($rents->RentPayment)
                                            @if ($rents->RentPayment->payment == null)
                                            <label><i class='fas fa-coins' data-toggle="tooltip"
                                                    data-title="Pembayaran menggunakan B-Poin" data-placement="bottom"></i>
                                                Pembayaran menggunakan B-Poin
                                            </label>
                                            <br>
                                            @else
                                            <label><i class='far fa-credit-card' data-toggle="tooltip"
                                                    data-title="Metode Pembayaran" data-placement="bottom"></i>
                                                {{ $rents->RentPayment->PaymentMethodDetail->PaymentMethod->name }}</label>
                                            @endif
                                        @endif

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
                                        @else
                                            <label><i class='far fa-circle' style='font-size:15px' data-toggle="tooltip"
                                                    data-title="Metode Booking" data-placement="bottom"></i>
                                                Offline
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
                                                @elseif ($rents->status == 5)
                                                    Booking Dibatalkan
                                                @endif
                                        @endif



                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    @if ($rents->RentPayment)
                                        @if ($rents->RentPayment->payment == null)
                                            <div class="form-group">
                                                <label> Pembayaran menggunakan B-Poin</label><br>
                                            </div>
                                        @else
                                        <div class="form-group">
                                            <label>Bukti Pembayaran </label><br>
                                            <img src="{{ asset('images/payment/' . $rents->RentPayment->payment) }}"
                                                alt="" style="width:300px; height:200px;">
                                        </div>
                                        @endif
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
                                                    @if ($rents->diskon_membership)
                                                        <tr>
                                                            <th colspan="2">Diskon Membership
                                                                ({{ $rents->field->Venue->membership_discount }}%)</th>
                                                            <td>-{{ Helper::rupiah($rents->diskon_membership) }}</td>
                                                        </tr>
                                                    @endif
                                                    @if ($rents->diskon)
                                                        <tr>
                                                            <th colspan="2">Diskon
                                                                ({{ $rents->kode_promo }})</th>
                                                            <td>-{{ Helper::rupiah($rents->diskon) }}</td>
                                                        </tr>
                                                    @endif
                                                    @if ($rents->RentPayment)
                                                        @if ($rents->RentPayment->note == "B-Poin")
                                                        <tr>
                                                            <th colspan="2">B-Poin</th>
                                                            <td>-{{ Helper::rupiah($rentDetail->OpeningHourDetail->price) }}
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endif
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

    {!! Form::open([
        'method' => 'PATCH',
        'route' => ['owner.booking.finish', 0],
        'style' => 'display:none',
        'id' => 'finish',
    ]) !!}
    {!! Form::close() !!}

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ url('api/select/schedule') }}?venue_id={{ $rents->Field->Venue->id }}&field_id={{ $rents->Field->id }}&date={{ $rents->date }}",
                dataType: 'json',
                cache: false,
                dataSrc: '',

                success: function(data) {
                    var detail_id = data.map(function(item) {
                        return item.detail_id;
                    });
                    var price = data.map(function(item) {
                        return item.price;
                    });
                    var hour = data.map(function(item) {
                        return item.hour;
                    });
                    var available = data.map(function(item) {
                        return item.available;
                    });
                    $(".selectgroup-item").remove();
                    for (i = 0; i < data.length; i++) {
                        if (available[i] == 2) {
                            var div = `<label class="selectgroup-item">
                                            <input selectgroup-itemInput type="checkbox" name="detail_id[]" value="` +
                                detail_id[i] + `" class="selectgroup-input selectgroup-itemInput"
                                                disabled>
                                            <span class="selectgroup-button" style="background-color:red; color:white">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        } else {
                            if (available[i - 1] == 2) {
                                var div = `<label class="selectgroup-item">
                                            <input selectgroup-itemInput type="checkbox" name="detail_id[]" value="` +
                                    detail_id[i] + `" class="selectgroup-input selectgroup-itemInput"
                                            onclick="selectCheckbox(this)">
                                            <span class="selectgroup-button">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                            } else {
                                var div = `<label class="selectgroup-item">
                                            <input selectgroup-itemInput type="checkbox" name="detail_id[]" value="` +
                                    detail_id[i] + `" class="selectgroup-input selectgroup-itemInput"
                                                disabled>
                                            <span class="selectgroup-button" style="background-color:grey; color:white">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                            }

                        }

                        $("#hour-checkbox").append(div);
                    }

                    console.log("data", data)
                }

            });

        });

        function selectCheckbox(data) {
            var index = $(data).index(".selectgroup-itemInput");
            console.log($(data));
            var ini = $(".selectgroup-itemInput").eq(index + 1);
            console.log($(ini));
            $(ini).prop("disabled", false);
            $(ini).attr('style', 'background-color:red');
        }

        function extend(data) {
            $.ajax({
                url: "{{ url('api/booking/extend') }}?id=" + data,
                dataType: 'json',
                cache: false,
                dataSrc: '',

                success: function(data) {
                    console.log(data);
                    console.log(data.tenant_name);
                    $('#m_tenant_name').text(data.tenant_name);
                    $('#m_venue').text(data.venue);
                    $('#m_field').text(data.field);
                    $('#m_date').text(data.date);
                }

            });
        }

        function finish(id) {
            console.log('Function called with ID:', id);
            swal({
                    title: "Apakah booking telah selesai?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#F9C99B",
                    confirmButtonText: "Ya, Selesaikan!",
                    cancelButtonText: "Tidak, batalkan!",
                    closeOnConfirm: false,
                    closeOnCancel: false

                },
                function(isConfirm) {
                    if (isConfirm) {

                        swal("Booking Selesai!", "Booking telah diselesaikan", "success");
                        $('#finish').attr('action', "/owner/booking/" + id + "/finish");
                        $('#finish').submit();
                    } else {
                        swal("Batal", "Anda batal menyelesaikan booking", "error");
                    }
                });
            console.log('After swal');
        }
    </script>
@endsection
