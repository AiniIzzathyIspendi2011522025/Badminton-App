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
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($histories as $rent_history )
                    @if (!$rent_history->Rent)
                    <tr>
                        <td class="date-col" colspan=5>
                            <center>History Booking Kosong</center>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="date-col">{{date('d-m-Y',strtotime($rent_history->Rent->date))}}</td>
                        <td class="product-col">
                            <div class="product">
                                <figure>
                                    <img src="{{ asset('images/field/'.$rent_history->Rent->Field->image) }}"
                                        alt="Product image" style="width:300px;height:150px;">
                                </figure>

                            </div><!-- End .product -->
                            <h3 class="product-title">
                                {{$rent_history->Rent->Field->name}} - {{$rent_history->Rent->Field->Venue->name}}
                            </h3><!-- End .product-title -->
                        </td>
                        <td class="stock-col">{{$rent_history->Rent->order('asc').'-'.$rent_history->Rent->order('desc')}}
                        </td>
                        <td class="price-col">{{Helper::rupiah($rent_history->Rent->total_price)}}</td>
                        <td class="action-col">
                            <a href="{{ route('customer.history.show', $rent_history->id) }}">
                                <button class="btn btn-block btn-outline-primary-2"><i class="icon-info-circle"></i>Detail
                                    Booking</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><!-- End .table table-wishlist -->
        <nav aria-label="Page navigation">
            <!-- <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1"
                        aria-disabled="true">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                    </a>
                </li>
                <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item-total">of 6</li>
                <li class="page-item">
                    <a class="page-link page-link-next" href="#" aria-label="Next">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            </ul> -->
        </nav>
    </div><!-- End .container -->
</div><!-- End .page-content -->


@endsection