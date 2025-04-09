<link href="../css/app.css" rel="stylesheet" />

@extends('layouts.landing.home')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        @include('layouts.landing.header.header')

        <div class="container">
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="header-bottom sticky-header bg-info">
    </div><!-- End .header-bottom -->

    <div class="page-content">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div style="margin-bottom: 24px" class="category-banners-slider owl-carousel owl-simple owl-nav-inside"
                        data-toggle="owl"
                        data-owl-options='{
                                "nav": false,
                                "responsive": {
                                    "768": {
                                        "nav": true
                                    }
                                }
                            }'>
                        <div class="banner banner-poster">
                            <a href="#">
                                <img src="{{ asset('templateLandings/assets/images/demos/demo-13/banners/bannerMembership.jpg') }}"
                                    alt="Banner" style="height: 400px;">
                            </a>
                            <div class="banner-content">
                                <h2 class="banner-title">Join Membership Sekarang</h2><!-- End .banner-subtitle -->
                                <h2 class="banner-title">Dan dapatkan diskon khusus membership di berbagai Lapangan</h2>
                                <!-- End .banner-title -->
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                        @foreach ($venues as $venue)
                            @if ($venue->isMembership)
                                <div class="banner banner-poster">
                                    <a href="{{ route('commerce.show', $venue->id) }}">
                                        <img src="{{ asset('templateLandings/assets/images/demos/demo-13/banners/BannerLapanganMembership.png') }}"
                                            style="height: 400px;" alt="Banner">
                                    </a>
                                    <div class="banner-content">
                                        <h2 class="banner-title text-danger text-center">{{ $venue->name }}</h2>
                                        <h2 class="banner-title text-danger text-center">Ini kesempatan kamu untuk
                                            mendapatkan pengalaman badminton yang lebih terjangkau! Dengan menjadi anggota
                                            lapangan badminton kami, kamu akan menikmati diskon eksklusif
                                            untuk membership!!!
                                        </h2>
                                        <h2 class="banner-title text-danger text-center">Diskon
                                            {{ $venue->membership_discount }}%</h2>
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                            @endif
                        @endforeach
                    </div><!-- End .owl-carousel -->

                    <div style="justify-content: center; margin-bottom: 24px; overflow: auto;"
                        class="d-flex flex-wrap gap-3">
                        <a href="{{ route('commerce.sortByType') }}?type=8">
                            <div style="background: url('{{ asset('images/lapangan/semen.png') }}'); width: 300px; height: 150px; background-size: cover;"
                                class="rounded">
                                <br><br><br><br>
                                <p style="text-align: center;" class="text-white h1">Lapangan Semen</p>
                            </div>
                        </a>
                        <a href="{{ route('commerce.sortByType') }}?type=9">
                            <div style="background: url('{{ asset('images/lapangan/kayu.png') }}'); width: 300px; height: 150px; background-size: cover; background-position: center;"
                                class="rounded">
                                <br><br><br><br>
                                <p style="text-align: center;" class="text-white h1">Lapangan Kayu</p>
                            </div>
                        </a>
                        <a href="{{ route('commerce.sortByType') }}?type=7">
                            <div style="background: url('{{ asset('images/lapangan/karpet.png') }}'); width: 300px; height: 150px; 	background-size: cover;"
                                class="rounded">
                                <br><br><br><br>
                                <p style="text-align: center;" class="text-white h1">Lapangan Karpet</p>
                            </div>
                        </a>
                    </div>

                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Menampilkan <span>{{ $venues->count() }}</span> Lapangan
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="col-12 col-md-4 col-xl-3">
                        <div class="product border" style="border-radius: 1.5rem;">
                            <figure class="product-media">
                                <a href="{{ route('commerce.show', $venue->id) }}">
                                    <img src="{{ asset('images/venue/' . $venue->FirstImage()->image) }}"
                                        alt="Product image" class="product-image" style="height: 120px;">
                                </a>
                            </figure>
                            <div class="product-body">
                                <h3 class="product-title h4">
                                    <a href="{{ route('commerce.show', $venue->id) }}">
                                        {{ $venue->name }}
                                    </a>
                                </h3>
                                <div style="font-size: 12px">
                                    <span>{{ $venue->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .products -->

                    <!-- <nav aria-label="Page navigation">                                                                                                                                 </nav> -->

                    <div style="margin-top: 24px" class="category-banners-slider owl-carousel owl-simple owl-nav-inside"
                        data-toggle="owl"
                        data-owl-options='{
                                "nav": false,
                                "responsive": {
                                    "768": {
                                        "nav": true
                                    }
                                }
                            }'>
                        <div class="banner banner-poster">
                            <a href="#">
                                <img src="{{ asset('templateLandings/assets/images/demos/demo-13/banners/BannerDiskon.jpg') }}"
                                    style="height: 400px;" alt="Banner">
                            </a>
                            <div class="banner-content" style= "padding-bottom: 100px">
                                <h2 class="banner-title">Dapatkan berbagai promo menarik</h2><!-- End .banner-subtitle -->
                                <h2 class="banner-title">Pada lapangan-lapangan berikut</h2>
                                <!-- End .banner-title -->
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                        @foreach ($venues as $venue)
                            @php
                                // Ambil promo pertama yang terkait dengan user_id dari Venue saat ini
                                $promo = $promo->where('user_id', $venue->user_id)->first();
                            @endphp

                            {{-- Periksa apakah ada promo yang terkait dengan Venue --}}
                            @if ($promo)
                                <div class="banner banner-poster">
                                    <a href="{{ route('commerce.show', $venue->id) }}">
                                        <img src="{{ asset('templateLandings/assets/images/demos/demo-13/banners/BannerLapanganDiskon.png') }}"
                                            style="height: 400px;" alt="Banner">
                                        <div style="padding-left: 320px" class="banner-content">
                                            <h2 class="banner-title text-danger text-center">{{ $venue->name }}</h2>
                                            <!-- End .banner-subtitle -->
                                            {{-- Tampilkan promo pertama untuk Venue saat ini --}}
                                            <h2 class="banner-title text-danger text-center ">Jangan lewatkan kesempatan
                                                istimewa ini!</h2>
                                            <h2 class="banner-title text-danger text-center ">Dapatkan diskon
                                                {{ $promo->diskon * 100 }}% hanya untuk Anda.</h2>
                                            <h2 class="banner-title text-danger text-center">Booking lapangan sekarang
                                                juga!!!
                                            </h2>
                                            <!-- End .banner-title -->
                                        </div><!-- End .banner-content -->
                                    </a>

                                </div><!-- End .banner -->
                            @endif
                        @endforeach


                    </div><!-- End .owl-carousel -->

                </div><!-- End .col-lg-9 -->

            </div><!-- End .row -->
        </div>
    </div>
@endsection
