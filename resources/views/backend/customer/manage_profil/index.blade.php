@extends('layouts.landing.home')

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Profil</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">

            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-detail-link" data-toggle="tab" href="#tab-detail"
                                        role="tab" aria-controls="tab-detail" aria-selected="false">Detail Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-edit-link" data-toggle="tab" href="#tab-edit" role="tab"
                                        aria-controls="tab-edit" aria-selected="false">Edit Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-password-link" data-toggle="tab" href="#tab-password"
                                        role="tab" aria-controls="tab-password" aria-selected="false">Ubah Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-membership-link" data-toggle="tab" href="#tab-membership"
                                        role="tab" aria-controls="tab-membership" aria-selected="false">Membership</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-point-link" data-toggle="tab" href="#tab-point"
                                        role="tab" aria-controls="tab-point" aria-selected="false">Point</a>
                                </li>
                                <li class="nav-item">
                                    <a onclick="logout()" class="nav-link" href="#">Log Out
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                                    </a>
                                </li>
                            </ul>
                        </aside><!-- End .col-lg-3 -->

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-detail" role="tabpanel"
                                    aria-labelledby="tab-detail-link">
                                    @foreach ($customers as $customer)
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="card card-dashboard">
                                                    <div class="card-body">
                                                        <h3 class="card-title">Profil</h3><!-- End .card-title -->

                                                        <p>Nama &emsp;: {{ $customer->first_name }}
                                                            {{ $customer->last_name }}<br>
                                                            Alamat &ensp;: {{ $customer->address }}<br>
                                                            No HP&emsp;&ensp;: {{ $customer->handphone }}<br>
                                                        </p>
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .card-dashboard -->
                                            </div><!-- End .col-lg-6 -->

                                            <div class="col-lg-4">
                                                <div class="card card-dashboard">
                                                    <center>
                                                        <img @if ($customer->avatar == null) src="{{ asset('templates/img/user.png') }}"
                                        @else
                                            src="{{ asset('images/customer/' . $customer->avatar) }}" @endif
                                                            alt="Product image" style="width:200px; height:200px"
                                                            class="product-image">
                                                    </center>
                                                </div><!-- End .card-dashboard -->
                                            </div><!-- End .col-lg-6 -->
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <div class="card card-dashboard">
                                                    <div class="card-body">
                                                        <h3 class="card-title mb-3">Poin per Venue</h3>

                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered align-middle mb-0">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th style="width: 60%;" class="text-center">Venue</th>
                                                                        <th class="text-center" style="width: 40%;">Total Poin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse($points as $point)
                                                                        <tr>
                                                                            <td class="text-center">{{ $point->venue->name ?? '-' }}</td>
                                                                            <td class="text-center">
                                                                                <span class="badge">
                                                                                    {{ $point->point_balance }} B-Poin
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        <tr>
                                                                            <td colspan="2" class="text-center text-muted">
                                                                                Belum ada poin
                                                                            </td>
                                                                        </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-edit" role="tabpanel" aria-labelledby="tab-edit-link">
                                    @include('backend.customer.manage_profil.edit')
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="tab-password" role="tabpanel"
                                    aria-labelledby="tab-password-link">
                                    @include('auth.passwords.change')
                                </div><!-- .End .tab-pane -->
                                <style>
                                .member-card {
                                    background: #0f2a44;           /* navy gelap */
                                    color: #fff;
                                    border-radius: 16px;
                                    padding: 20px 22px;
                                    position: relative;
                                    overflow: hidden;
                                    min-height: 180px;
                                }
                                .member-card .watermark {
                                    position: absolute;
                                    right: -30px; bottom: -20px;
                                    font-weight: 800;
                                    font-size: 72px;
                                    opacity: .06; letter-spacing: 2px;
                                    text-transform: uppercase;
                                    pointer-events: none;
                                    user-select: none;
                                }
                                .member-card .brand-mark {
                                    position: absolute;
                                    top: 16px; right: 16px;
                                    width: 58px; height: 58px;
                                    border: 2px solid #fff; border-radius: 10px;
                                    display: grid; place-items: center;
                                    font-weight: 800; letter-spacing: 1px;
                                }
                                .member-card .title {
                                    font-weight: 800;
                                    font-size: 22px;
                                    letter-spacing: 2px;
                                    margin: 12px 0 14px;
                                }
                                .member-card .label {
                                    font-size: 11px; opacity: .8; letter-spacing: 1px;
                                }
                                .member-card .bar {
                                    height: 22px; background: #f2f4f7; border-radius: 4px; margin: 4px 0 10px;
                                }
                                .member-card .small-box {
                                    height: 22px; background: #f2f4f7; border-radius: 4px; margin-top: 4px;
                                }
                                .member-card .meta {
                                    font-size: 11px; opacity: .85; letter-spacing: .5px;
                                }
                                .member-card .badge-status {
                                    position: absolute; top: 16px; left: 16px;
                                    font-size: 11px; letter-spacing: .6px;
                                    background: #16a34a; /* default aktif */
                                    border-radius: 999px; padding: 4px 10px; font-weight: 600;
                                }
                                .member-card.status-processing .badge-status { background:#fbbf24; color:#111827; }
                                .member-card.status-inactive  .badge-status { background:#6b7280; }
                                </style>

                                <div class="tab-pane fade" id="tab-membership" role="tabpanel" aria-labelledby="tab-membership-link">
                                <div class="col g-4">
                                    @foreach ($memberships as $m)
                                    @php
                                        $statusClass = $m->membership_status === 1 ? 'status-active' : ($m->membership_status === 2 ? 'status-processing' : 'status-inactive');
                                        $statusText  = $m->membership_status === 1 ? 'AKTIF' : ($m->membership_status === 2 ? 'SEDANG DIPROSES' : 'TIDAK AKTIF');
                                        $FirstLetter = strtoupper(substr($m->venue->name, 0, 2));
                                    @endphp

                                    <div class="col mb-2">
                                    <div class="member-card {{ $statusClass }}">
                                        {{-- Badge status & Brand mark di pojok atas --}}
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="brand-mark z-3">{{ $FirstLetter }}</div>
                                            <span class="badge-status">{{ $statusText }}</span>
                                        </div>

                                        {{-- Judul --}}
                                        <h5 class="text-center fw-bold mb-3 text-white">MEMBERSHIP CARD</h5>

                                        {{-- Nama Member --}}
                                        <div class="mb-2">
                                            <div class="label text-uppercase">Name</div>
                                            <div class="bar d-flex align-items-center px-2 text-dark"
                                                title="{{ $m->user->last_name }} {{ $m->user->first_name ?? '-' }}">
                                                <small class="text-truncate">
                                                    {{ $m->user->last_name }} {{ $m->user->first_name ?? '-' }}
                                                </small>
                                            </div>
                                        </div>

                                        {{-- Member No., Since, dan End Date --}}
                                        <div class="row g-2 mb-2">
                                            <div class="col-4">
                                                <div class="label text-uppercase">Member ID.</div>
                                                <div class="small-box d-flex align-items-center px-2 text-dark"
                                                    title="{{ $m->id ?? '-' }}">
                                                    <small class="text-truncate w-100">{{ $FirstLetter }} - {{ $m->id ?? '—' }}</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="label text-uppercase">Since</div>
                                                <div class="small-box d-flex align-items-center px-2 text-dark"
                                                    title="{{ \Carbon\Carbon::parse($m->start_date)->format('M Y') }}">
                                                    <small class="text-truncate w-100">
                                                        {{ \Carbon\Carbon::parse($m->start_date)->format('d M Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="label text-uppercase">End Date</div>
                                                <div class="small-box d-flex align-items-center px-2 text-dark"
                                                    title="{{ \Carbon\Carbon::parse($m->end_date)->format('M Y') }}">
                                                    <small class="text-truncate w-100">
                                                        {{ \Carbon\Carbon::parse($m->end_date)->format('d M Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Footer: alamat venue --}}
                                        <div class="d-flex flex-wrap gap-1 mt-3 meta small text-white">
                                            <span class="text-uppercase fw-semibold">{{ $m->venue->name }}</span>
                                            <span>•</span>
                                            <span>{{ $m->venue->address ?? '—' }}</span>
                                        </div>

                                        {{-- Watermark dekoratif --}}
                                        <div class="watermark">Member</div>
                                    </div>
                                </div>

                                    @endforeach
                                </div>
                                </div>


                                <div class="tab-pane fade" id="tab-point" role="tabpanel" aria-labelledby="tab-point-link">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tanggal Transaksi</th>
                                                <th scope="col">Venue</th>
                                                <th scope="col">Point Earned</th>
                                                <th scope="col">Point Spend</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($point_transactions as $point_transaction)
                                                <tr>
                                                    <td>{{ $point_transaction->created_at }}</td>
                                                    <td>{{ $point_transaction->rent->Field->Venue->name }}</td>
                                                    <td>{{ $point_transaction->point_earned }}</td>
                                                    <td>-{{ $point_transaction->point_spent }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- .End .tab-pane -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

    {!! Form::open([
        'method' => 'GET',
        'route' => ['customer.profil.edit', 0],
        'style' => 'display.none',
        'id' => 'edit_profil',
    ]) !!}
    {!! Form::close() !!}
@endsection

@section('script')
    <script>
        function edit(id) {
            $('#edit_profil').attr('action', "{{ route('customer.profil.index') }}/" + id + "/edit");
            $('#edit_profil').submit();
        }
    </script>
@endsection
