@extends('layouts.admin.home')

@section('content')
    <!-- Main Content -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="page-content d-flex justify-content-lg-around">
        <div class="col-lg-5 ml-5 d-none d-lg-block">
            <div class="bg-white rounded">
                <div class="card px-4 py-5"
                    style="background: url({{ asset('images/icon_bank/dashboardicon.svg') }}); background-position: top; background-size: contain; background-repeat: no-repeat">
                    <div class="card-body" style="padding: 73px 0;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7" id="2-card-satu-baris">
            <div class="row">
                <div class="col-6 col-lg-5 col-md-6 rounded">
                    <div class="card" style="background-color: #6FB6A6;">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 ">
                                    <h6 class="text-muted font-semibold text-white h4">Jumlah Owner</h6>
                                    <h6 class="font-extrabold mb-0 text-white h4">{{ $owners }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-5 col-md-6">
                    <div class="card" style="background-color: #8b94a5">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-white h4">Jumlah Venue</h6>
                                    <h6 class="font-extrabold mb-0 text-white h4">{{ $venues }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-5 col-md-6">
                    <div class="card" style="background-color: #687387">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-white h4">Perlu dikonfirmasi</h6>
                                    <h6 class="font-extrabold mb-0 text-white h4">{{ $isConfirmed }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-5 col-md-6">
                    <div class="card bg-success">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold text-white h4">Total Penyewa</h6>
                                    <h6 class="font-extrabold mb-0 text-white h4">{{ $customer }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
