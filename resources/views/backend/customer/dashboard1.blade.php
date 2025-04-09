@extends('layouts.customer.home')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Top Navigation</h1>

    </div>

    <div class="section-body">
        <h2 class="section-title">This is Example Page</h2>
        <p class="section-lead">This page is just an example for you to create your own page.</p>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Filtering</h4>
                    </div>
                    <div class="card-body">
                        This is some text within a card body.
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Lapangan yytfuy </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div data-crop-image="200">
                                    <img alt="image" src="{{ asset('templates/img/example-image.jpg') }}"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Alamat : </b>bcshby</p>
                                <p><b>Informasi : </b>feegvfhe</p>
                                <p><b>Biaya : </b>feegvfhe</p>
                                <p><b>Fasilitas : </b>dfaaf</p>
                                <button class="btn btn-primary">Lihat Lapangan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection