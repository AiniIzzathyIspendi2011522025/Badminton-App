@extends('layouts.landing.home')

@section('css')
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel="stylesheet" href="{{ asset('templates/css/custom/selectgroup.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/chatPopup/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    {{-- <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic);

        ul li {
            list-style: none;
        }

        .fabs {
            bottom: 0;
            position: fixed;
            margin: 1em;
            right: 0;
            z-index: 998;

        }

        .fab {
            display: block;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            text-align: center;
            color: #f0f0f0;
            margin: 25px auto 0;
            box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0, .28);
            cursor: pointer;
            -webkit-transition: all .1s ease-out;
            transition: all .1s ease-out;
            position: relative;
            z-index: 998;
            overflow: hidden;
            background: #42a5f5;
        }

        .fab>i {
            font-size: 2em;
            line-height: 55px;
            -webkit-transition: all .2s ease-out;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .fab:not(:last-child) {
            width: 0;
            height: 0;
            margin: 20px auto 0;
            opacity: 0;
            visibility: hidden;
            line-height: 40px;
        }

        .fab:not(:last-child)>i {
            font-size: 1.4em;
            line-height: 40px;
        }

        .fab:not(:last-child).is-visible {
            width: 40px;
            height: 40px;
            margin: 15px auto 10;
            opacity: 1;
            visibility: visible;
        }

        .fab:nth-last-child(1) {
            -webkit-transition-delay: 25ms;
            transition-delay: 25ms;
        }

        .fab:not(:last-child):nth-last-child(2) {
            -webkit-transition-delay: 20ms;
            transition-delay: 20ms;
        }

        .fab:not(:last-child):nth-last-child(3) {
            -webkit-transition-delay: 40ms;
            transition-delay: 40ms;
        }

        .fab:not(:last-child):nth-last-child(4) {
            -webkit-transition-delay: 60ms;
            transition-delay: 60ms;
        }

        .fab:not(:last-child):nth-last-child(5) {
            -webkit-transition-delay: 80ms;
            transition-delay: 80ms;
        }

        .fab(:last-child):active,
        .fab(:last-child):focus,
        .fab(:last-child):hover {
            box-shadow: 0 0 6px rgba(0, 0, 0, .16), 0 6px 12px rgba(0, 0, 0, .32);
        }

        /*Chatbox*/

        .chat {
            position: fixed;
            right: 85px;
            bottom: 20px;
            width: 400px;
            font-size: 12px;
            line-height: 22px;
            font-family: 'Roboto';
            font-weight: 500;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
            opacity: 0;
            box-shadow: 1px 1px 100px 2px rgba(0, 0, 0, 0.22);
            border-radius: 10px;
            -webkit-transition: all .2s ease-out;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        .chat_fullscreen {
            position: fixed;
            right: 0px;
            bottom: 0px;
            top: 0px;
        }

        .chat_header {
            /* margin: 10px; */
            font-size: 13px;
            font-family: 'Roboto';
            font-weight: 500;
            color: #f3f3f3;
            height: 55px;
            background: #42a5f5;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding-top: 8px;
        }

        .chat_header2 {
            /* margin: 10px; */
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }

        .chat_header .span {
            float: right;
        }

        .chat_fullscreen_loader {
            display: none;
            float: right;
            cursor: pointer;
            /* margin: 10px; */
            font-size: 20px;
            opacity: 0.5;
            /* padding: 20px; */
            margin: -10px 10px;
        }

        .chat.is-visible {
            opacity: 1;
            -webkit-animation: zoomIn .2s cubic-bezier(.42, 0, .58, 1);
            animation: zoomIn .2s cubic-bezier(.42, 0, .58, 1);
        }

        .is-hide {
            opacity: 0
        }

        .chat_option {
            float: left;
            font-size: 15px;
            list-style: none;
            position: relative;
            height: 100%;
            width: 100%;
            text-align: relative;
            margin-right: 10px;
            letter-spacing: 0.5px;
            font-weight: 400
        }


        .chat_option img {
            border-radius: 50%;
            width: 55px;
            float: left;
            margin: -30px 20px 10px 20px;
            border: 4px solid rgba(0, 0, 0, 0.21);
        }

        .change_img img {
            width: 35px;
            margin: 0px 20px 0px 20px;
        }

        .chat_option .agent {
            font-size: 12px;
            font-weight: 300;
        }

        .chat_option .online {
            opacity: 0.4;
            font-size: 11px;
            font-weight: 300;
        }

        .chat_color {
            display: block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin: 10px;
            float: left;
        }


        .chat_body {
            background: #fff;
            width: 100%;

            display: inline-block;
            text-align: center;
            overflow-y: auto;

        }

        #chat_body {
            height: 450px;
        }

        .chat_login p,
        .chat_body li,
        p,
        a {
            -webkit-animation: zoomIn .5s cubic-bezier(.42, 0, .58, 1);
            animation: zoomIn .5s cubic-bezier(.42, 0, .58, 1);
        }

        .chat_body p {
            padding: 20px;
            color: #888
        }

        .chat_body a {
            width: 10%;
            text-align: center;
            border: none;
            box-shadow: none;
            line-height: 40px;
            font-size: 15px;
        }



        .chat_field {
            position: relative;
            margin: 5px 0 5px 0;
            width: 50%;
            font-family: 'Roboto';
            font-size: 12px;
            line-height: 30px;
            font-weight: 500;
            color: #4b4b4b;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
            border: none;
            outline: none;
            display: inline-block;
        }

        .chat_field.chat_message {
            height: 30px;
            resize: none;
            font-size: 13px;
            font-weight: 400;
        }

        .chat_category {
            text-align: left;
        }

        .chat_category {
            margin: 20px;
            background: rgba(0, 0, 0, 0.03);
            padding: 10px;
        }

        .chat_category ul li {
            width: 80%;
            height: 30px;
            background: #fff;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #e0e0e0;
            font-size: 13px;
            cursor: pointer;
            line-height: 30px;
            color: #888;
            text-align: center;
        }

        .chat_category li:hover {
            background: #83c76d;
            color: #fff;
        }

        .chat_category li.active {
            background: #83c76d;
            color: #fff;
        }

        .tags {
            margin: 20px;
            bottom: 0px;
            display: block;
            width: 120%
        }

        .tags li {
            padding: 5px 10px;
            border-radius: 40px;
            border: 1px solid rgb(3, 117, 208);
            margin: 5px;
            display: inline-block;
            color: rgb(3, 117, 208);
            cursor: pointer;

        }

        .fab_field {
            width: 100%;
            display: inline-block;
            text-align: center;
            background: #fff;
            border-top: 1px solid #eee;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;

        }

        .fab_field2 {
            bottom: 0px;
            position: absolute;
            border-bottom-right-radius: 0px;
            border-bottom-left-radius: 0px;
            z-index: 999;
        }

        .fab_field a {
            display: inline-block;
            text-align: center;
        }

        #fab_camera {
            float: left;
            background: rgba(0, 0, 0, 0);
        }

        #fab_send {
            float: right;
            background: rgba(0, 0, 0, 0);
        }

        .fab_field .fab {
            width: 35px;
            height: 35px;
            box-shadow: none;
            margin: 5px;
        }

        .fab_field .fab>i {
            font-size: 1.6em;
            line-height: 35px;
            color: #bbb;
        }

        .fab_field .fab>i:hover {
            color: #42a5f5;
        }

        .chat_conversion {}

        .chat_converse {
            position: relative;
            background: #fff;
            margin: 6px 0 0px 0;
            height: 300px;
            min-height: 0;
            font-size: 12px;
            line-height: 18px;
            overflow-y: auto;
            width: 100%;
            float: right;
            padding-bottom: 100px;
        }

        .chat_converse2 {
            height: 100%;
            max-height: 800px
        }

        .chat_list {
            opacity: 0;
            visibility: hidden;
            height: 0;
        }

        .chat_list .chat_list_item {
            opacity: 0;
            visibility: hidden;
        }

        .chat .chat_converse .chat_msg_item {
            position: relative;
            margin: 8px 0 15px 0;
            padding: 8px 10px;
            max-width: 60%;
            display: block;
            word-wrap: break-word;
            border-radius: 3px;
            -webkit-animation: zoomIn .5s cubic-bezier(.42, 0, .58, 1);
            animation: zoomIn .5s cubic-bezier(.42, 0, .58, 1);
            clear: both;
            z-index: 999;
        }

        .status {
            margin: 45px -50px 0 0;
            float: right;
            font-size: 11px;
            opacity: 0.3;
        }

        .status2 {
            margin: -10px 20px 0 0;
            float: right;
            display: block;
            font-size: 11px;
            opacity: 0.3;
        }

        .chat .chat_converse .chat_msg_item .chat_avatar {
            position: absolute;
            top: 0;
        }

        .chat .chat_converse .chat_msg_item.chat_msg_item_admin .chat_avatar {
            left: -52px;
            background: rgba(0, 0, 0, 0.03);
        }

        .chat .chat_converse .chat_msg_item.chat_msg_item_user .chat_avatar {
            right: -52px;
            background: rgba(0, 0, 0, 0.6);
        }

        .chat .chat_converse .chat_msg_item .chat_avatar,
        .chat_avatar img {
            width: 40px;
            height: 40px;
            text-align: center;
            border-radius: 50%;
        }

        .chat .chat_converse .chat_msg_item.chat_msg_item_admin {
            margin-left: 60px;
            float: left;
            background: rgba(0, 0, 0, 0.03);
            color: #666;
        }

        .chat .chat_converse .chat_msg_item.chat_msg_item_user {
            margin-right: 20px;
            float: right;
            background: #42a5f5;
            color: #eceff1;
        }

        .chat .chat_converse .chat_msg_item.chat_msg_item_admin:before {
            content: '';
            position: absolute;
            top: 15px;
            left: -12px;
            z-index: 998;
            border: 6px solid transparent;
            border-right-color: rgba(255, 255, 255, .4);
        }

        .chat_form .get-notified label {
            color: #077ad6;
            font-weight: 600;
            font-size: 11px;
        }

        input {
            position: relative;
            width: 90%;
            font-family: 'Roboto';
            font-size: 12px;
            line-height: 20px;
            font-weight: 500;
            color: #4b4b4b;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
            outline: none;
            background: #fff;
            display: inline-block;
            resize: none;
            padding: 5px;
            border-radius: 3px;
        }

        .chat_form .get-notified input {
            margin: 2px 0 0 0;
            border: 1px solid #83c76d;
        }

        .chat_form .get-notified i {
            background: #83c76d;
            width: 30px;
            height: 32px;
            font-size: 18px;
            color: #fff;
            line-height: 30px;
            font-weight: 600;
            text-align: center;
            margin: 2px 0 0 -30px;
            position: absolute;
            border-radius: 3px;
        }

        .chat_form .message_form {
            margin: 10px 0 0 0;
        }

        .chat_form .message_form input {
            margin: 5px 0 5px 0;
            border: 1px solid #e0e0e0;
        }

        .chat_form .message_form textarea {
            margin: 5px 0 5px 0;
            border: 1px solid #e0e0e0;
            position: relative;
            width: 90%;
            font-family: 'Roboto';
            font-size: 12px;
            line-height: 20px;
            font-weight: 500;
            color: #4b4b4b;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
            outline: none;
            background: #fff;
            display: inline-block;
            resize: none;
            padding: 5px;
            border-radius: 3px;
        }

        .chat_form .message_form button {
            margin: 5px 0 5px 0;
            border: 1px solid #e0e0e0;
            position: relative;
            width: 95%;
            font-family: 'Roboto';
            font-size: 12px;
            line-height: 20px;
            font-weight: 500;
            color: #fff;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
            outline: none;
            background: #fff;
            display: inline-block;
            resize: none;
            padding: 5px;
            border-radius: 3px;
            background: #83c76d;
            cursor: pointer;
        }

        strong.chat_time {
            padding: 0 1px 1px 0;
            font-weight: 500;
            font-size: 8px;
            display: block;
        }

        /*Chatbox scrollbar*/

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            border-radius: 0;
        }

        ::-webkit-scrollbar-thumb {
            margin: 2px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.2);
        }

        /*Element state*/

        .is-active {
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
            -webkit-transition: all 1s ease-in-out;
            transition: all 1s ease-in-out;
        }

        .is-float {
            box-shadow: 0 0 6px rgba(0, 0, 0, .16), 0 6px 12px rgba(0, 0, 0, .32);
        }

        .is-loading {
            display: block;
            -webkit-animation: load 1s cubic-bezier(0, .99, 1, 0.6) infinite;
            animation: load 1s cubic-bezier(0, .99, 1, 0.6) infinite;
        }

        /*Animation*/

        @-webkit-keyframes zoomIn {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
                opacity: 0.0;
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
                opacity: 0.0;
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 1;
            }
        }

        @-webkit-keyframes load {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
                opacity: 0.0;
            }

            50% {
                -webkit-transform: scale(1.5);
                transform: scale(1.5);
                opacity: 1;
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0;
            }
        }

        @keyframes load {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
                opacity: 0.0;
            }

            50% {
                -webkit-transform: scale(1.5);
                transform: scale(1.5);
                opacity: 1;
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0;
            }
        }

        /* SMARTPHONES PORTRAIT */

        @media only screen and (min-width: 300px) {
            .chat {
                width: 250px;
            }
        }

        /* SMARTPHONES LANDSCAPE */

        @media only screen and (min-width: 480px) {
            .chat {
                width: 300px;
            }

            .chat_field {
                width: 65%;
            }
        }

        /* TABLETS PORTRAIT */

        @media only screen and (min-width: 768px) {
            .chat {
                width: 300px;
            }

            .chat_field {
                width: 65%;
            }
        }

        /* TABLET LANDSCAPE / DESKTOP */

        @media only screen and (min-width: 1024px) {
            .chat {
                width: 300px;
            }

            .chat_field {
                width: 65%;
            }
        }

        /*Color Options*/



        .blue .fab {
            background: #42a5f5;
            color: #fff;
        }



        .blue .chat {
            background: #42a5f5;
            color: #999;
        }


        /* Ripple */

        .ink {
            display: block;
            position: absolute;
            background: rgba(38, 50, 56, 0.4);
            border-radius: 100%;
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            webkit-transform: scale(0);
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        /*animation effect*/

        .ink.animate {
            -webkit-animation: ripple 0.5s ease-in-out;
            animation: ripple 0.5s ease-in-out;
        }

        @-webkit-keyframes ripple {
            /*scale the element to 250% to safely cover the entire link and fade it out*/

            100% {
                opacity: 0;
                -moz-transform: scale(5);
                -ms-transform: scale(5);
                webkit-transform: scale(5);
                -webkit-transform: scale(5);
                transform: scale(5);
            }
        }

        @keyframes ripple {
            /*scale the element to 250% to safely cover the entire link and fade it out*/

            100% {
                opacity: 0;
                -moz-transform: scale(5);
                -ms-transform: scale(5);
                webkit-transform: scale(5);
                -webkit-transform: scale(5);
                transform: scale(5);
            }
        }

        ::-webkit-input-placeholder {
            /* Chrome */
            color: #bbb;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            color: #bbb;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: #bbb;
        }

        :-moz-placeholder {
            /* Firefox 4 - 18 */
            color: #bbb;
        }
    </style> --}}
@endsection

@section('content')
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">

        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-top">
                        <div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="w-100" src="{{ asset('images/venue/' . $venue->FirstImage()->image) }}"
                                        alt="First slide" style="height: 400px">
                                </div>
                                @foreach ($venue->VenueImage as $VenueImage)
                                    <div class="carousel-item">
                                        <img class="w-100" src="{{ asset('images/venue/' . $VenueImage->image) }}"
                                            alt="Second slide" style="height: 400px">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="product-details product-details-sidebar">
                                    <h1 class="product-title">{{ $venue->name }}</h1>
                                    <h6>{{ $venue->address }}</h6>
                                    <h6>{{ $venue->phone_number }}</h6>
                                    <h6>{{ $venue->information }}</h6>
                                    <!-- End .product-title -->
                                    {{-- <div class="product-price">
                                    {{Helper::rupiah($venue->rangePrice('asc')->price)}} -
                                    {{Helper::rupiah($venue->rangePrice('desc')->price)}}
                                </div><!-- End .product-price --> --}}
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                            <div class="col">
                                {{-- <div class="product-details product-details-sidebar">
                                    <br>
                                    <p><b>Opening Hours</b></p>
                                    @foreach ($openingHours as $openingHour)
                                        <p><b>- {{ $openingHour->Day->name }} :</b></p>
                                        <div class="badges">
                                            @foreach ($venue->OpeningHour as $open)
                                                @if ($openingHour->day_id == $open->day_id)
                                                    @if ($open->status == 2)
                                                        @if ($open->checkAvailable())
                                                            <span
                                                                class="badge badge-success">{{ $open->Hour->hour }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $open->Hour->hour }}</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div> --}}
                                <div class="p-3 mb-2"
                                    style="border-radius: 8px; width: 35rem; margin-left: auto;
                                    box-shadow:rgba(37, 40, 43, 0.08) 0px 1px 6px 0px">
                                    <h5 class="text-center">Ketersedian Lapangan</h5>
                                    <a href="#jadwal-lapangan" style="border-radius: 6px"
                                        class="btn btn-primary mx-auto d-block">
                                        <span>Cek Sekarang</span>
                                    </a>

                                </div>
                                @if (Auth::user())
                                    @if ($venue->isMembership === 1 && !$membership)
                                        <div class="p-3 mb-5"
                                            style="border-radius: 8px; width: 35rem; margin-left: auto;
                                    box-shadow:rgba(37, 40, 43, 0.08) 0px 1px 6px 0px">
                                            <div class="card-body">
                                                <h5 class="card-subtitle text-muted mb-1 text-center">Membership</h5>
                                                <h6 class="mb-1 text-center">Jadi membership dan dapatkan lebih banyak
                                                    keuntungan</h6>
                                                <a href="/membership/{{ $venue->id }}" style="border-radius: 6px"
                                                    class="btn btn-primary mx-auto d-block">
                                                    <span>Gabung Membership</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->

                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-field-link" data-toggle="tab"
                                    href="#product-field-tab" role="tab" aria-controls="product-field-tab"
                                    aria-selected="false">Lapangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                    role="tab" aria-controls="product-info-tab" aria-selected="false">Fasilitas</a>
                            </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link" id="product-map-link" data-toggle="tab" href="#product-map-tab"
                                role="tab" aria-controls="product-map-tab" aria-selected="true">Map</a>
                        </li> --}}
                            {{-- <li class="nav-item">
                            <a class="nav-link" id="product-gallery-link" data-toggle="tab" href="#product-gallery-tab"
                                role="tab" aria-controls="product-gallery-tab" aria-selected="true">Gallery Venue</a>
                        </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                    role="tab" aria-controls="product-desc-tab" aria-selected="true">Informasi
                                    Pemilik &
                                    Pembayaran</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-field-tab" role="tabpanel"
                                aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                                        data-toggle="owl"
                                        data-owl-options='{
                                                    "nav": false,
                                                    "dots": true,
                                                    "margin": 20,
                                                    "loop": false,
                                                    "responsive": {
                                                        "0": {
                                                            "items":1
                                                        },
                                                        "480": {
                                                            "items":2
                                                        },
                                                        "768": {
                                                            "items":3
                                                        },
                                                        "992": {
                                                            "items":4
                                                        },
                                                        "1200": {
                                                            "items":4,
                                                            "nav": true,
                                                            "dots": false
                                                        }
                                                    }
                                                }'>
                                        @foreach ($field as $field)
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    <img src="{{ asset('images/field/' . $field->image) }}"
                                                        alt="Product image" class="product-image"
                                                        style="width: 300px; height: 150px;">
                                                    </a>
                                                </figure><!-- End .product-media -->

                                                <div class="product-body">
                                                    <div class="product-cat" style="color:grey;">
                                                        {{ $field->fieldType->name }}
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title">{{ $field->name }}</h3>
                                                    <!-- End .product-title -->
                                                    <div class="product-price">

                                                    </div><!-- End .product-price -->

                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        @endforeach

                                    </div><!-- End .owl-carousel -->
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                                aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    <div>
                                        <div>
                                            @foreach ($venue->ActiveFacilityDetail() as $facility)
                                                <p class="badge badge-info" style="padding:10px;">
                                                    {{ $facility->Facility->name }}
                                                </p>
                                            @endforeach
                                            @if ($venue->OtherFacility)
                                                @foreach ($venue->OtherFacility as $OtherFacility)
                                                    <p class="badge badge-info" style="padding:10px;">
                                                        {{ $OtherFacility->name }}
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-map-tab" role="tabpanel"
                                aria-labelledby="product-map-link">
                                <div class="product-map-content">
                                    <div class="google-map" id="map-show" style="height:400px"></div>

                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-gallery-tab" role="tabpanel"
                                aria-labelledby="product-gallery-link">
                                <div class="product-desc-content">
                                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                                        data-toggle="owl"
                                        data-owl-options='{
                                                    "nav": false,
                                                    "dots": true,
                                                    "margin": 20,
                                                    "loop": false,
                                                    "responsive": {
                                                        "0": {
                                                            "items":1
                                                        },
                                                        "480": {
                                                            "items":2
                                                        },
                                                        "768": {
                                                            "items":3
                                                        },
                                                        "992": {
                                                            "items":4
                                                        },
                                                        "1200": {
                                                            "items":4,
                                                            "nav": true,
                                                            "dots": false
                                                        }
                                                    }
                                                }'>
                                        @foreach ($venue->VenueImage as $VenueImage)
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    <img src="{{ asset('images/venue/' . $VenueImage->image) }}"
                                                        alt="Product image" class="product-image"
                                                        style="width: 300px; height: 150px;">
                                                </figure><!-- End .product-media -->
                                            </div><!-- End .product -->
                                        @endforeach

                                    </div><!-- End .owl-carousel -->
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-desc-tab" role="tabpanel"
                                aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <div class="row">
                                        <div class="col-4">
                                            <ul>Nama Pemilik : {{ $venue->owner->first_name }}
                                                {{ $venue->owner->last_name }}</ul>
                                            <ul>No Hp Pemilik : {{ $venue->owner->handphone }}</ul>
                                            <ul>Alamat Pemilik : {{ $venue->owner->address }}</ul>
                                        </div>
                                        <div class="col-4">
                                            <p>Metode Pembayaran</p>
                                            @foreach ($venue->paymentMethodDetail as $paymentMethodDetail)
                                                <p>- {{ $paymentMethodDetail->PaymentMethod->name }} (
                                                    {{ $paymentMethodDetail->no_rek }} )</p>
                                            @endforeach
                                        </div>
                                        <div class="col-4">
                                            <p>Jenis Pembayaran</p>
                                            @if ($venue->dp_percentage != null)
                                                <p><b>- Pembayaran dengan DP sebesar {{ $venue->dp_percentage }} %</b></p>
                                                <p><b>- Pembayaran Lunas</b></p>
                                            @else
                                                <p><b>- Pembayaran Lunas</b></p>
                                            @endif
                                            <b></b>
                                        </div>
                                    </div>

                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->


                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->
                    @include('backend.customer.manage_booking.create')

                </div><!-- End .col-lg-9 -->


            </div><!-- End .row -->


        </div><!-- End .container -->
    </div><!-- End .page-content -->
@endsection

@section('script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.toastrDefaultWarning').click(function() {
                toastr.warning('harap login terlebih dahulu')
            });
        });


        let mapCreate;
        let mapShow;
        let markers = [];
        // When the window has finished loading google map
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions1 = {
                zoom: 17,
                center: new google.maps.LatLng(-0.9111111111111111, 100.34972222222221),
                // Style for Google Maps
                styles: [{
                    "featureType": "water",
                    "stylers": [{
                        "saturation": 43
                    }, {
                        "lightness": -11
                    }, {
                        "hue": "#0088ff"
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "hue": "#ff0000"
                    }, {
                        "saturation": -100
                    }, {
                        "lightness": 99
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#808080"
                    }, {
                        "lightness": 54
                    }]
                }, {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ece2d9"
                    }]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ccdca1"
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#767676"
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "landscape.natural",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "color": "#b8cb93"
                    }]
                }, {
                    "featureType": "poi.park",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi.sports_complex",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi.medical",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi.business",
                    "stylers": [{
                        "visibility": "simplified"
                    }]
                }]
            };

            // Get all html elements for map
            var mapElement3 = document.getElementById('map-show');

            // Create the Google Map using elements
            var map = new google.maps.Map(mapElement3, mapOptions1);


            // Variabel untuk menyimpan batas kordinat
            bounds = new google.maps.LatLngBounds();



            $.ajax({
                url: "{{ url('api/venue/get-location') }}?id={{ $venue->id }}",
                dataType: 'json',
                cache: false,
                dataSrc: '',

                success: function(data) {
                    var latitude = data.map(function(item) {
                        return item.latitude;
                    });
                    var longitude = data.map(function(item) {
                        return item.longitude;
                    });
                    var latlng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
                    console.log(latitude);
                    console.log(longitude);
                    for (i = 0; i < data.length; i++) {
                        var pos = {
                            lat: parseFloat(latitude[i]),
                            lng: parseFloat(longitude[i])
                        };
                        var marker = new google.maps.Marker({
                            position: pos,
                            map: map,
                            title: 'Lokasi Anda',
                            icon: '{{ asset('templates/img/venue_map.png') }}',
                            draggable: true,
                            animation: google.maps.Animation.DROP
                        });
                        marker.setMap(map);
                        map.setCenter(latlng);
                        // for(i=0; i<arrays.length; i++){
                        //     var data = arrays
                        //     console.log(data.properties.center['latitude']);
                        // }
                    }
                }

            });
        }

        $('#c_field').prop("disabled", false);
        $('#c_venue').prop("disabled", true);


        function dateChange() {
            $('#c_field').prop("disabled", false);
            $(".selectgroup-item").remove();
        }

        $('#c_select_field').prop("disabled", true);

        function dateChange() {
            $('#c_select_field').prop("disabled", false);
            $('#c_select_field').val(0).change();
            $(".selectgroup-item").remove();
        }
        $('#c_select_field').on('change', function(e) {
            let venue_id = $('#c_venue').val();
            var field_id = $('#c_select_field').val();
            var date = $('#c_date').val();
            $.ajax({
                url: "{{ url('api/select/schedule') }}?venue_id=" + venue_id + "&field_id=" + field_id +
                    "&date=" + date,
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
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input"
                                                disabled>
                                            <span class="selectgroup-button" style="background-color:red; color:white">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        } else if (available[i] == 3) {
                            var div = `<label class="selectgroup-item">
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input" disabled>
                                            <span class="selectgroup-button" style="background-color:grey; color:white">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        } else {
                            var div = `<label class="selectgroup-item">
                                            <input type="checkbox" name="detail_id[]" value="` + detail_id[i] + `" class="selectgroup-input">
                                            <span class="selectgroup-button">
                                                <b>` + hour[i] + `</b><br>
                                                <b>` + price[i] / 1000 + `K</b>
                                            </span>
                                        </label>`;
                        }

                        $("#hour-checkbox").append(div);
                    }

                    console.log(data)
                }

            });
        });

        var radio = 1;

        function checkbox(data) {
            let checked = [];
            for (var i = 0; i < $('.selectgroup-input').length; i++) {
                if ($('.selectgroup-input').eq(i).prop('checked') == true) {
                    checked.push($('.selectgroup-input').eq(i).val());
                }
            }
            $.post(
                "{{ url('api/pricing/set-price') }}", {
                    id: checked,
                    status: radio,
                    venue_id: "{{ $venue->id }}"
                },
                function(result) {
                    $('#price').val(result.price).change();
                    $('#dp').val(result.dp).change();
                }
            )
        }

        $(':radio').on('click', function(e) {
            if ($(this).val() == 1) {
                radio = 1;
                $('#col-dp').hide();
                $('#dp').val(0).change();
            } else {
                radio = 2;
                $('#col-dp').show();
            }

        });
    </script>
@endsection
