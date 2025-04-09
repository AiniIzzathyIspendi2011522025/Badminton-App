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
                    <h1>Kelola Promo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Promo</li>
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
                            <h3 class="card-title">Promo</h3>
                            <a class="card-title btn btn-success" href="/owner/promo/create"
                                style="float:right;margin-left:200px;">Tambah Promo</a>
                        </div>


                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTables-booking">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Diskon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promo as $p)
                                        <tr class="text-center">
                                            <td>{{ $p->kode }}</td>
                                            <td>{{ $p->diskon * 100 }}%</td>
                                            <td>
                                                <a href="/owner/promo/{{ $p->id }}/edit" class="btn btn-warning">
                                                    <i class="fa fa-pen text-white"></i>
                                                </a>
                                                <a href="/owner/promo/{{ $p->id }}" class="btn btn-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
