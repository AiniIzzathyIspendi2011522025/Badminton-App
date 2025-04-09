@extends('layouts.landing.home')

@section('content')
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title" style="background-color:white;">
                Detail Pembayaran Membership<span>Membership</span>
            </h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">

    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <form action="/membership/{{ $venue->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Venue</th>
                                        <th>Harga</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $venue->name }}</td>
                                        <td>{{ Helper::rupiah($venue->membership_price) }}</td>
                                        <td>1 bulan</td>
                                    </tr>
                                </tbody>
                            </table><!-- End .table table-wishlist -->
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-5">
                            <div class="summary summary-cart">
                                <br>
                                <h3 class="summary-title">Detail</h3><!-- End .summary-title -->
                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-shipping-row">
                                            <td>Nama :</td>
                                            <td>{{ Auth::user()->first_name }}
                                                {{ Auth::user()->last_name }}
                                            </td>
                                        </tr>
                                        <tr class="summary-shipping-row">
                                            <td>Tanggal : </td>
                                            <td>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total : </td>
                                            <td>{{ Helper::rupiah($venue->membership_price) }}</td>
                                        </tr>

                                        <tr class="summary-shipping">
                                            <td colspan="2">Metode Pembayaran :</td>
                                            <td></td>
                                        </tr>
                                        @foreach ($venue->paymentMethodDetail as $paymentMethodDetail)
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio"
                                                            id="bank-{{ $paymentMethodDetail->payment_method_id }}"
                                                            name="payment_method" required
                                                            value="{{ $paymentMethodDetail->id }}"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="bank-{{ $paymentMethodDetail->payment_method_id }}">{{ $paymentMethodDetail->PaymentMethod->name }}
                                                            ({{ $paymentMethodDetail->no_rek }})
                                                        </label>
                                                    </div><!-- End .custom-control -->
                                                </td>
                                                <td>&nbsp;</td>
                                            </tr><!-- End .summary-shipping-row -->
                                        @endforeach
                                        <tr class="summary-shipping-estimate" id="form-bank" style="display:none">
                                            <td><input type="text" class="form-control" name="bank" id="bank"
                                                    readonly></td>
                                            <td>&nbsp;</td>
                                        </tr><!-- End .summary-shipping-estimate -->

                                        <tr class="summary-shipping-row">
                                            <td colspan="2">Bukti Pembayaran :</td>
                                            <td></td>
                                        </tr><!-- End .summary-total -->
                                        <tr class="summary-shipping-row">
                                            <td colspan="2"><input type="file" id="payment" name="payment"
                                                    accept="image/*" class="form-control"></td>
                                            <td></td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <div id="submit">
                                    <button type="submit"
                                        class="btn btn-success btn-order btn-block rounded ">Bayar</button>
                                </div>
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
@endsection
