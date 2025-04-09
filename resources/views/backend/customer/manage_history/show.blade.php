@extends('layouts.landing.home')

@section('content')
<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Detail Pemesanan<span>History Booking</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">

</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <img src="{{ asset('images/field/'.$histories->Rent->Field->image) }}" alt=""
                        style="width:250px;height:150px;">
                    <table class="table table-cart table-mobile">
                        <thead>
                            <tr>
                                <th>Venue</th>
                                <th>Lapangan</th>
                                <th>Waktu</th>
                                <th>Harga</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($histories->Rent->RentDetail as $historyRentDetail )
                            <tr>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        {{$historyRentDetail->rent->Field->Venue->name}}
                                    </h3><!-- End .product-title -->
                                </td>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        {{$historyRentDetail->rent->Field->name}}
                                    </h3><!-- End .product-title -->
                                </td>
                                <td class="price-col">{{$historyRentDetail->OpeningHourDetail->OpeningHour->Hour->hour}}
                                </td>
                                <td class="price-col">{{Helper::rupiah($historyRentDetail->OpeningHourDetail->price)}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table><!-- End .table table-wishlist -->
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-5">
                    <div class="summary summary-cart">

                        <h3 class="summary-title">Detail</h3><!-- End .summary-title -->
                        <table class="table table-summary">
                            <tbody>
                                    <tr class="summary-shipping-row">
                                        <td width="40%">Nama :</td>
                                        <td>{{$histories->Rent->tenant_name}}</td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>Tanggal :</td>
                                        <td>{{date('d-m-Y',strtotime($histories->Rent->date))}}</td>
                                    </tr>
                                    <tr class="summary-total">
                                        <td>Total :</td>
                                        <td>{{Helper::rupiah($histories->Rent->total_price)}}</td>
                                    </tr>
                                @if ($histories->Rent->status == 1 && Carbon\Carbon::now() >= Carbon\Carbon::parse($histories->created_at)->addMinutes(10))
                                    <tr>
                                        <td colspan=2>
                                            <center>
                                                <h3 style="color:red">EXPIRED</h3>
                                            </center>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="summary-shipping-row">
                                        <td>Status Pemesanan :</td>
                                        <td>
                                            @if ($histories->Rent->status == 1)
                                            <b>Sedang Diajukan</b>
                                            @elseif ($histories->Rent->status == 2)
                                            <b>Dibooking</b>
                                            @elseif ($histories->Rent->status == 3)
                                            <b>Ditolak</b>
                                            @elseif ($histories->Rent->status == 4)
                                            <b>Selesai</b>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>Status Pembayaran :</td>
                                        <td>
                                            @if ($histories->Rent->payment_status == 1)
                                            <b>Pembayaran Lunas</b>
                                            @elseif ($histories->Rent->payment_status == 2)
                                            <b>Pembayaran dengan DP
                                                {{$histories->Rent->Field->Venue->dp_percentage}} %</b>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($histories->Rent->dp != NULL)
                                    <tr class="summary-shipping-row">
                                        <td>Total DP :</td>
                                        <td><b>{{Helper::rupiah($histories->Rent->dp)}}</b></td>
                                    </tr>
                                    @endif
                                    <tr class="summary-shipping-row">
                                        <td>Metode Pembayaran :</td>
                                        <td><b>Bank Mandiri</b></td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td colspan="2">Bukti Pembayaran :</td>
                                        <td></td>
                                    </tr><!-- End .summary-total -->
                                    <tr class="summary-shipping-row">
                                        <td colspan=2>
                                            <figure>
                                                <img src="{{ asset('images/payment/'.$histories->Rent->RentPayment->payment) }}"
                                                    alt="Product image" style="width:300px;height:150px;">
                                            </figure>
                                        </td>
                                        <td></td>
                                    </tr><!-- End .summary-total -->
                                @endif
                            </tbody>
                        </table><!-- End .table table-summary -->
                    </div><!-- End .summary -->

                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->
@endsection