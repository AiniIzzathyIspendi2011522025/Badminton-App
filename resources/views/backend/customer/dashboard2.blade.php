@extends('layouts.customer.home')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Top Navigation <small>Example 3.0</small></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                    <li class="breadcrumb-item active">Top Navigation</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>

                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of the card's
                            content.
                        </p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Lapangan yytfuy </h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                
                                <p class="card-text"><b>Alamat : </b>bcshby</p>
                                <p class="card-text"><b>Informasi : </b>feegvfhe</p>
                                <p class="card-text"><b>Biaya : </b>feegvfhe</p>
                                <p class="card-text"><b>Fasilitas : </b>dfaaf</p>
                                <a href="#" class="btn btn-primary">Lihat Jadwal dan Lapangan</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <div data-crop-image="200">
                                    <img alt="image" src="{{ asset('templatesAdminLTE/img/photo1.png') }}"
                                    class="img-circle img-fluid">
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Featured</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>

            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection