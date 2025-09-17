@extends('layouts.landing.home')

@section('content')
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Detail Pemesanan<span>Booking</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <img src="{{ asset('images/field/' . $rents->Field->image) }}" alt=""
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
                                @foreach ($rents->RentDetail as $rentDetail)
                                    <tr>
                                        <td class="product-col">
                                            <h3 class="product-title">
                                                {{ $rentDetail->rent->Field->Venue->name }}
                                            </h3><!-- End .product-title -->
                                        </td>
                                        <td class="product-col">
                                            <h3 class="product-title">
                                                {{ $rentDetail->rent->Field->name }}
                                            </h3><!-- End .product-title -->
                                        </td>
                                        <td class="price-col">{{ $rentDetail->OpeningHourDetail->OpeningHour->Hour->hour }}
                                        </td>
                                        <td class="price-col">{{ Helper::rupiah($rentDetail->OpeningHourDetail->price) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-5">
                        <div class="summary summary-cart">

                            <div class="summary-title d-flex justify-content-between">
                                <h3>Detail</h3>
                                <a href="/booking/{{ $rents->id }}/cetak">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        strokeWidth={1.5} stroke="currentColor" className="w-2 h-2">
                                        <path strokeLinecap="round" strokeLinejoin="round"
                                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                    </svg>
                                    Cetak</a>
                            </div>
                            <!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-shipping-row">
                                        <td width="40%">Nama :</td>
                                        <td>{{ $rents->tenant_name }}</td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>Tanggal :</td>
                                        <td>{{ date('d-m-Y', strtotime($rents->date)) }}</td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>subtotal :</td>
                                        @if ($rents->RentPayment->note == 'B-Poin')
                                        <td>{{ Helper::rupiah($rents->diskon + $rents->diskon_membership + $rents->total_price + $price) }}</td>
                                        @else
                                        <td>{{ Helper::rupiah($rents->diskon + $rents->diskon_membership + $rents->total_price) }}</td>
                                        @endif
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>Diskon Membership ({{ $rents->field->Venue->membership_discount }}%):</td>
                                        <td>-{{ Helper::rupiah($rents->diskon_membership) }}</td>
                                    </tr>
                                    @if ($rents->RentPayment->note == 'B-Poin')
                                        <tr class="summary-shipping-row">
                                            <td>Diskon B-Poin :</td>
                                            <td>-{{ Helper::rupiah($price) }}</td>
                                        </tr>
                                    @endif
                                    @if ($rents->kode_promo)
                                        <tr class="summary-shipping-row" style="color:red;">
                                            <td>Diskon ({{ $rents->kode_promo }}) :</td>
                                            <td>-{{ Helper::rupiah($rents->diskon) }}</td>
                                        </tr>
                                    @endif
                                    <tr class="summary-total">
                                        <td>Total :</td>
                                        <td>{{ Helper::rupiah($rents->total_price) }}</td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>Status Pemesanan :</td>
                                        <td>
                                            @if ($rents->status == 1)
                                                <b>Sedang diajukan</b>
                                            @elseif ($rents->status == 2)
                                                <b>Dibooking</b>
                                            @elseif ($rents->status == 3)
                                                <b>Booking Ditolak</b>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>Status Pembayaran :</td>
                                        <td>
                                            @if ($rents->payment_status == 1)
                                                <b>Pembayaran Lunas</b>
                                            @elseif ($rents->payment_status == 2)
                                                <b>Pembayaran dengan DP {{ $rents->Field->Venue->dp_percentage }} %</b>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($rents->dp != null)
                                        <tr class="summary-shipping-row">
                                            <td>Total DP :</td>
                                            <td><b>{{ Helper::rupiah($rents->dp) }}</b></td>
                                        </tr>
                                    @endif
                                    @if ($rents->RentPayment->payment == null)
                                             <tr class="summary-shipping-row">
                                        <td>Metode Pembayaran :</td>
                                        <td><b>B-Poin</b></td>
                                    </tr>
                                    @else
                                    <tr class="summary-shipping-row">
                                        <td>Metode Pembayaran :</td>
                                        <td><b>{{ $rents->RentPayment->PaymentMethodDetail->PaymentMethod->name }}</b></td>
                                    </tr>
                                    @endif
                                    @if ($rents->RentPayment->payment !== null)
                                    <tr class="summary-shipping-row">
                                        <td colspan="2">Bukti Pembayaran :</td>
                                        <td></td>
                                    </tr><!-- End .summary-total -->
                                    <tr class="summary-shipping-row">
                                        <td colspan=2>
                                            <figure>
                                                <img src="{{ asset('images/payment/' . $rents->RentPayment->payment) }}"
                                                    alt="Product image" style="width:300px;height:150px;">
                                            </figure>
                                        </td>
                                        <td></td>
                                    @endif

                                        @php
                                            use Illuminate\Support\Facades\Request;
                                            @endphp

                                        <div class="visible-print text-center"
                                        style="margin-top: 25px; margin-bottom: 50px;" style="color: black">
                                        {!! QrCode::size(100)->generate('http://localhost:8000/owner/booking/' . $rents->id . '/show') !!}

                                        </div>
                                        </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                        </div><!-- End .summary -->

                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
@endsection
