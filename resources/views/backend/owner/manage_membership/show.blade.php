@extends('layouts.owner.home')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('templates/css/custom/selectgroup.css') }}">
@endsection

@section('content')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Str;

        // Hitung durasi dalam bulan dari tanggal (lebih akurat daripada hanya count_month)
        $start = $membership->start_date ? Carbon::parse($membership->start_date) : null;
        $end   = $membership->end_date ? Carbon::parse($membership->end_date) : null;

        $durationByDate = ($start && $end) ? max(1, $start->diffInMonths($end)) : null;
        $durationMonths = $durationByDate ?? ($membership->count_month ?: 1);

        $pricePerMonth  = $membership->venue->membership_price ?? 0;
        $totalPrice     = $pricePerMonth * $durationMonths;

        // Peta status → label & badge
        $statusMap = [
            1 => ['label' => 'Aktif',                'badge' => 'success'],
            2 => ['label' => 'Menunggu Konfirmasi',  'badge' => 'warning'],
            3 => ['label' => 'Ditolak',              'badge' => 'danger'],
            0 => ['label' => 'Tidak Aktif',          'badge' => 'secondary'],
        ];
        $status      = $statusMap[$membership->membership_status] ?? ['label' => 'Tidak diketahui', 'badge' => 'secondary'];
    @endphp

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="mb-0">Detail Membership</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('owner.membership.owner') }}">Membership</a></li>
                        <li class="breadcrumb-item active">Detail membership</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Detail Membership</h3>

                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-{{ $status['badge'] }} mr-2">{{ $status['label'] }}</span>

                        @if ($membership->membership_status == 2)
                            {{-- Menunggu konfirmasi: tampilkan aksi --}}
                            <a href="/owner/membership/{{ $membership->id }}/reject" class="btn btn-sm btn-outline-danger ml-2">
                                Tolak
                            </a>
                            <a href="/owner/membership/{{ $membership->id }}/confirm" class="btn btn-sm btn-success ml-2">
                                Terima
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="d-block">
                                    <i class="fas fa-user-alt mr-1" data-toggle="tooltip" data-title="Nama Member"></i>
                                    {{ $membership->user->first_name }} {{ $membership->user->last_name }}
                                </label>

                                <label class="d-block">
                                    <i class="fas fa-clock mr-1" data-toggle="tooltip" data-title="Total Membership"></i>
                                    Total Membership: {{ $durationMonths }} Bulan
                                </label>

                                <label class="d-block">
                                    <i class="fas fa-calendar-alt mr-1" data-toggle="tooltip" data-title="Mulai"></i>
                                    Mulai: {{ $membership->start_date ? date('d-m-Y', strtotime($membership->start_date)) : '-' }}
                                </label>

                                <label class="d-block">
                                    <i class="fas fa-calendar-alt mr-1" data-toggle="tooltip" data-title="Berakhir"></i>
                                    Berakhir: {{ $membership->end_date ? date('d-m-Y', strtotime($membership->end_date)) : '-' }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                        @if ($membership->payment)
                            <div class="form-group">
                                <label>Bukti Pembayaran </label><br>
                                <img src="{{ asset('images/payment/' . $membership->payment) }}" alt="" style="width:300px; height:200px;">
                            </div>
                        @endif
                        </div>
                    </div> {{-- row --}}
                </div> {{-- card-body --}}

                <div class="px-3">
                    <div class="form-group">
                        <label class="ml-2">
                            Detail Membership ( {{ $membership->user->first_name }} {{ $membership->user->last_name }} — {{ $membership->venue->name }} )
                        </label>

                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Venue</th>
                                        <th>Harga / Bulan</th>
                                        <th>Durasi (Bulan)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $membership->user->first_name }} {{ $membership->user->last_name }}</td>
                                        <td>{{ $membership->venue->name }}</td>
                                        <td>{{ Helper::rupiah($pricePerMonth) }}</td>
                                        <td>{{ $durationMonths }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Total Harga</th>
                                        <th>{{ Helper::rupiah($totalPrice) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div> {{-- card --}}

        </div>
    </section>
@endsection
