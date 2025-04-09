@extends('layouts.owner.home')


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('templates/css/custom/selectgroup.css') }}">
@endsection


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Promo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Promo</li>
                        <li class="breadcrumb-item active">Tambah Promo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">


                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Tambah Promo</h3>
                        </div>


                        <div class="card-body">
                            <div class="container">
                                <form action="/owner/promo" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kode">Kode:</label>
                                        <input type="text" class="form-control" id="kode" name="kode"
                                            placeholder="Masukkan kode">
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon">Diskon (%):</label>
                                        <input type="number" class="form-control" id="diskon" name="diskon"
                                            placeholder="Masukkan diskon" min="0" max="100" step="any">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->


    </section>
@endsection
