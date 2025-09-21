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
                    <h1>Kelola Membership</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Membership</li>
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
                        <div class="card-header">
                            <h3 class="card-title">List Membership
                            </h3>
                            {{-- <button style="float:right;margin-left:200px;" type="button" class="btn btn-success"
                                data-toggle="modal" data-target="#modal-booking">Tambah Booking Offline
                            </button> --}}
                        </div>
                        <div class="card-body">
                            @if (!$memberships)
                                <p class="text-center">Tidak ada Data membership</p>
                            @else
                                <table id="example1" class="table table-bordered table-striped dataTables-booking">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Venue</th>
                                            <th>Mulai</th>
                                            <th>Berakhir</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($memberships as $membership)
                                            <tr>
                                                <td>{{ $membership['nama_member'] }}</td>
                                                <td>{{ $membership['nama_venue'] }}</td>
                                                <td>{{ $membership['start_date'] }}</td>
                                                <td>{{ $membership['end_date'] }}</td>
                                                @if ($membership['membership_status'] === 1)
                                                    <td>Aktif</td>
                                                    <td>
                                                        <a href="/owner/membership/{{ $membership['membership_id'] }}"
                                                            class="btn btn-info">Detail</a>
                                                    </td>
                                                @elseif ($membership['membership_status'] === 2)
                                                    <td>Sedang di Proses</td>
                                                    <td>
                                                        <a href="/owner/membership/{{ $membership['membership_id'] }}"
                                                            class="btn btn-info">Detail</a>
                                                        <a href="/owner/membership/{{ $membership['membership_id'] }}/confirm"
                                                            class="btn btn-success">Terima</a>
                                                        <a href="/owner/membership/{{ $membership['membership_id'] }}/reject"
                                                            class="btn btn-danger">Tolak</a>
                                                    </td>
                                                @elseif ($membership['membership_status'] === 3)
                                                    <td>Ditolak</td>
                                                    <td>
                                                        <a href="/owner/membership/{{ $membership['membership_id'] }}"
                                                            class="btn btn-info">Detail</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="/owner/membership/{{ $membership['membership_id'] }}"
                                                            class="btn btn-info">Detail</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
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

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
