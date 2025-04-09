@extends('layouts.landing.home')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="page-content">
    <div class="container">
        <table class="table table-wishlist table-mobile">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Lapangan</th>
                    <th>Waktu</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($histories)
                    @foreach ($histories as $rent_history )
                        <tr>
                            <td class="date-col">{{date('d-m-Y',strtotime($rent_history->Rent->date))}} </td>
                            <td class="product-col">
                                <div class="product">
                                    <figure>
                                        <img src="{{ asset('images/field/'.$rent_history->Rent->Field->image) }}"
                                            alt="Product image" style="width:300px;height:150px;">
                                    </figure>
                                </div>
                                <h3 class="product-title">{{$rent_history->Rent->Field->name}} -
                                    {{$rent_history->Rent->Field->Venue->name}}</h3>
                            </td>
                            <td class="stock-col">{{$rent_history->Rent->order('asc').'-'.$rent_history->Rent->order('desc')}}
                            </td>
                            <td class="price-col">{{Helper::rupiah($rent_history->Rent->total_price)}}</td>
                        @if ($rent_history->Rent->RentPayment)
                            @if ($rent_history->Rent->status == 1)
                            <td class="stock-col"><span class="in-stock" style="color:grey">
                                    Sedang diajukan
                                </span></td>
                            @elseif ($rent_history->Rent->status == 2)
                            <td class="stock-col"><span class="in-stock">
                                    Dibooking
                                </span></td>
                            @elseif ($rent_history->Rent->status == 3)
                            <td class="stock-col"><span class="in-stock" style="color:red">
                                    Booking ditolak
                                </span></td>
                            @elseif ($rent_history->Rent->status == 4)
                            <td class="stock-col"><span class="in-stock" style="color:blue">
                                    Selesai
                                </span></td>
                            @endif
                        @else
                            @if (Carbon\Carbon::now() >= Carbon\Carbon::parse($rent_history->created_at)->addMinutes(10))
                            <td class="stock-col"><span class="in-stock" style="color:red">
                                    Expired
                                </span></td>
                            @else
                            <td class="stock-col"><span class="in-stock" style="color:orange">
                                    Menunggu pembayaran
                                </span></td>
                            @endif
                        @endif

                            @if ($rent_history->Rent->rentPayment)
                            <!-- kalau udah dibayar, tombol detail yang muncul-->
                                <td class="action-col">
                                    <a href="{{ route('customer.booking.show', $rent_history->Rent->id) }}">
                                        <button class="btn btn-block btn-outline-primary-2"><i class="icon-info-circle"></i>Detail
                                            Booking</button>
                                    </a>
                                </td>
                            @else
                                <td class="action-col">
                                    <!-- pembayaran ke halaman detail payment-->
                                    <a href="{{ route('customer.payment.detailPayment', $rent_history->Rent->id) }}">
                                        <button class="btn btn-block btn-outline-primary-2"><i class="icon-info-circle"></i>Lakukan
                                            Pembayaran</button>
                                    </a>
                                </td>
                            @endif
                        </tr>

                    @endforeach
                @elseif (!$histories)
                    <tr>
                        <td class="date-col" colspan=5>
                            <center>List Booking Kosong</center>
                        </td>
                    </tr>
                @endif

            </tbody>
        </table><!-- End .table table-wishlist -->
    </div><!-- End .container -->
</div><!-- End .page-content -->
@endsection
