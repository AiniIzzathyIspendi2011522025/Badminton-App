{{-- resources/views/landing/index.blade.php --}}
@extends('layouts.landing.home')

@section('content')
    @include('layouts.landing.header.header')

    {{-- ====== CSS UTILITIES (khusus halaman ini) ====== --}}
    <style>
        /* Radius & shadow */
        .rounded-4 { border-radius: 1rem; }
        .rounded-5 { border-radius: 1.5rem; }
        .shadow-soft { box-shadow: 0 10px 30px rgba(0,0,0,.12); }
        .text-shadow-sm { text-shadow: 0 1px 2px rgba(0,0,0,.25); }

        /* Badge pill */
        .badge-pill {
            display:inline-block; padding:.4rem .7rem; border-radius:9999px; font-weight:600; font-size:.8rem;
        }

        /* Horizontal scroll (tanpa plugin) */
        .h-scroll {
            display:grid; grid-auto-flow:column; grid-auto-columns: 85%;
            gap: 1rem; overflow-x:auto; scroll-snap-type:x mandatory; padding-bottom:.25rem;
        }
        @media (min-width:768px){ .h-scroll{ grid-auto-columns: 48%; } }
        @media (min-width:1200px){ .h-scroll{ grid-auto-columns: 32%; } }
        .snap { scroll-snap-align:start; }

        /* Gradient card (tanpa gambar) */
        .card-gradient {
            position:relative; overflow:hidden; border:0; color:#fff;
            background:
                radial-gradient(1200px 500px at -10% -10%, rgba(34,211,238,.35), transparent 60%),
                radial-gradient(800px 400px at 110% 0%, rgba(167,139,250,.35), transparent 60%),
                linear-gradient(135deg, #0ea5e9, #7c3aed);
        }
        .card-gradient .overlay-dim {
            position:absolute; inset:0; background: linear-gradient(to top, rgba(0,0,0,.35), rgba(0,0,0,.05));
        }

        /* Blob accent */
        .blob {
            position:absolute; width:380px; height:380px; filter: blur(40px); opacity:.35; z-index:0;
            background:
                radial-gradient(circle at 30% 30%, #22d3ee, transparent 55%),
                radial-gradient(circle at 70% 60%, #a78bfa, transparent 55%),
                radial-gradient(circle at 40% 80%, #34d399, transparent 55%);
            transform: translate(-10%, -10%);
        }

        /* Patterns */
        .pattern-dots {
            background-image: radial-gradient(currentColor 1px, transparent 1px);
            background-size: 12px 12px;
            opacity:.2;
        }
        .pattern-stripes {
            background: repeating-linear-gradient(
                45deg, rgba(255,255,255,.15) 0 10px, rgba(255,255,255,.05) 10px 20px
            );
        }

        /* Promo ribbon */
        .ribbon {
            position:absolute; top:12px; left:-8px; z-index:2; background:#ef4444; color:#fff;
            padding:.35rem .9rem; font-weight:700; border-top-right-radius:.5rem; border-bottom-right-radius:.5rem;
            box-shadow:0 6px 14px rgba(239,68,68,.35);
        }

        /* Icon bubble */
        .icon-bubble {
            width:48px; height:48px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center;
            background: rgba(255,255,255,.2); border:1px solid rgba(255,255,255,.35);
        }

        /* Hover raise */
        .card-raise { transition:.25s ease; }
        .card-raise:hover { transform:translateY(-4px); box-shadow:0 16px 36px rgba(0,0,0,.18); }

        /* Clamp text */
        .line-1 { white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .line-2 {
            display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
        }

        /* Hero tanpa gambar (full CSS gradient) */
        .hero {
            position:relative; color:#fff; overflow:hidden;
            background:
                radial-gradient(1000px 600px at -10% -10%, #22d3ee33, transparent 60%),
                radial-gradient(1200px 600px at 110% 0%, #a78bfa33, transparent 60%),
                radial-gradient(1000px 500px at 50% 120%, #34d39933, transparent 60%),
                linear-gradient(135deg, #0ea5e9, #7c3aed);
        }
        .hero .hero-overlay { position:absolute; inset:0; background: linear-gradient(180deg, rgba(0,0,0,.0), rgba(0,0,0,.2)); }
    </style>

    {{-- ====== HERO (tanpa gambar) ====== --}}
    {{-- <section class="hero mb-5">
        <div class="hero-overlay"></div>
        <div class="container py-5 position-relative" style="z-index:1;">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge-pill bg-white text-dark">Booking Lapangan Mudah</span>
                    <h1 class="fw-bold display-5 text-shadow-sm mt-3">Main Badminton Lebih Hemat & Fleksibel</h1>
                    <p class="lead mt-2">Gabung membership untuk harga spesial, dan cek promo aktif untuk potongan terbaik.</p>
                    <div class="mt-3">
                        <a href="#membership" class="btn btn-light btn-lg fw-semibold me-2">Lihat Membership</a>
                        <a href="#promo" class="btn btn-outline-light btn-lg fw-semibold">Promo Aktif</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block position-relative">
                    <div class="blob"></div>
                    <div class="position-absolute top-0 end-0 w-100 h-100 pattern-dots" style="color:#fff;"></div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Kategori Cepat --}}
    <section class="container mb-5">
        <h3 class="fw-bold mb-4 text-center">Jelajahi Berdasarkan Jenis Lapangan</h3>
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-4">
                <a href="{{ route('commerce.sortByType') }}?type=8" class="text-decoration-none">
                    <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                        <img src="{{ asset('images/lapangan/semen.png') }}" class="card-img-top"
                            style="height:180px; object-fit:cover;" alt="Lapangan Semen">
                        <div class="card-body text-center bg-dark text-white">
                            <h5 class="mb-0">Lapangan Semen</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="{{ route('commerce.sortByType') }}?type=9" class="text-decoration-none">
                    <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                        <img src="{{ asset('images/lapangan/kayu.png') }}" class="card-img-top"
                            style="height:180px; object-fit:cover;" alt="Lapangan Kayu">
                        <div class="card-body text-center bg-dark text-white">
                            <h5 class="mb-0">Lapangan Kayu</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="{{ route('commerce.sortByType') }}?type=7" class="text-decoration-none">
                    <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                        <img src="{{ asset('images/lapangan/karpet.png') }}" class="card-img-top"
                            style="height:180px; object-fit:cover;" alt="Lapangan Karpet">
                        <div class="card-body text-center bg-dark text-white">
                            <h5 class="mb-0">Lapangan Karpet</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ====== MEMBERSHIP (tanpa image) ====== --}}
    <section id="membership" class="container mb-5">
        <div class="text-center mb-4">
            <span class="badge-pill bg-primary bg-opacity-10 text-primary border border-primary">Membership</span>
            <h3 class="fw-bold mt-2">Lapangan dengan Membership</h3>
            <div class="text-muted">Menampilkan {{ $venues->where('isMembership', true)->count() }} lapangan</div>
        </div>

        <div class="h-scroll">
            {{-- Slide CTA Membership --}}
            <div class="snap">
                <div class="card card-gradient rounded-5 shadow-soft card-raise">
                    <div class="overlay-dim"></div>
                    <div class="blob d-none d-md-block"></div>
                    <div class="position-absolute w-100 h-100 pattern-stripes"></div>
                    <div class="card-body position-relative" style="z-index:1; padding:2rem;">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="icon-bubble me-2">
                                {{-- shuttlecock inline SVG --}}
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 3l12 12-3 3L3 6 6 3z" stroke="white" stroke-width="1.5"/>
                                    <path d="M14 14l3 3" stroke="white" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <span class="badge-pill bg-white text-dark">Eksklusif</span>
                        </div>
                        <h4 class="fw-bold text-shadow-sm mb-1">Join Member & Hemat Tiap Booking</h4>
                        <p class="mb-3 opacity-90">Dapatkan harga spesial, prioritas jadwal, dan promo terbatas hanya untuk member.</p>
                        <a href="#promo" class="btn btn-light fw-semibold">Lihat Promo</a>
                    </div>
                </div>
            </div>

            {{-- Loop lapangan membership --}}
            @foreach ($venues as $venue)
                @if ($venue->isMembership)
                    <div class="snap">
                        <a href="{{ route('commerce.show', $venue->id) }}" class="text-decoration-none">
                            <div class="card rounded-5 shadow-soft card-raise h-100" style="background: linear-gradient(135deg,#22c55e,#06b6d4); color:#fff;">
                                <div class="position-absolute top-0 end-0 m-3 badge-pill bg-white text-dark">Membership</div>
                                <div class="position-absolute w-100 h-100 pattern-dots" style="color:#fff;"></div>
                                <div class="card-body position-relative" style="z-index:1; padding:1.5rem;">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div class="icon-bubble me-2">
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                <circle cx="12" cy="12" r="9" stroke="white" stroke-width="1.5"/>
                                                <path d="M8 12h8M12 8v8" stroke="white" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                        @if(!empty($venue->membership_discount))
                                            <span class="badge-pill bg-white text-dark">Diskon {{ $venue->membership_discount }}%</span>
                                        @else
                                            <span class="badge-pill bg-white text-dark">Harga Spesial</span>
                                        @endif
                                    </div>
                                    <h5 class="fw-bold mb-1 line-1">{{ $venue->name }}</h5>
                                    <p class="mb-0 opacity-90 line-2">{{ $venue->address }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- ====== SEMUA LAPANGAN ====== --}}
    <section class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0">Semua Lapangan</h3>
            <span class="text-muted">Menampilkan {{ $venues->count() }} lapangan</span>
        </div>
        <div class="row g-4">
            @foreach ($venues as $venue)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="card border-0 shadow-soft h-100 rounded-4 overflow-hidden card-raise">
                        <a href="{{ route('commerce.show', $venue->id) }}" class="text-decoration-none text-dark">
                            <div class="position-relative">
                                @php
                                    $firstImage = optional($venue->FirstImage())->image ?? null;
                                @endphp
                                @if($firstImage)
                                    <img src="{{ asset('images/venue/' . $firstImage) }}"
                                         class="card-img-top" style="height: 150px; object-fit: cover;"
                                         alt="{{ $venue->name }}">
                                @else
                                    {{-- Placeholder tanpa gambar --}}
                                    <div class="w-100" style="height:150px; background:linear-gradient(135deg,#e5e7eb,#cbd5e1);"></div>
                                @endif
                                @if($venue->isMembership)
                                    <span class="badge-pill bg-success text-white position-absolute top-0 start-0 m-2">Member</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1 line-1">{{ $venue->name }}</h6>
                                <p class="small text-muted mb-0 line-2">{{ $venue->address }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ====== PROMO (tanpa image) ====== --}}
    <section id="promo" class="container mb-5">
        <div class="text-center mb-4">
            <span class="badge-pill bg-danger bg-opacity-10 text-danger border border-danger">Promo</span>
            <h3 class="fw-bold mt-2">Promo Aktif</h3>
            <div class="text-muted">Hemat di lapangan tertentu — buruan sebelum habis!</div>
        </div>

        <div class="row g-4">
            {{-- Kartu CTA promo umum --}}
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card card-gradient rounded-5 shadow-soft card-raise" style="background-image: linear-gradient(135deg,#ef4444,#f97316);">
                    <div class="overlay-dim"></div>
                    <div class="position-absolute w-100 h-100 pattern-stripes"></div>
                    <div class="card-body position-relative text-white" style="z-index:1; padding:2rem;">
                        <div class="ribbon">Hot Deal</div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="icon-bubble me-2">
                                {{-- percent icon --}}
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 5L5 19" stroke="white" stroke-width="1.5"/>
                                    <circle cx="8.5" cy="8.5" r="2" stroke="white" stroke-width="1.5"/>
                                    <circle cx="15.5" cy="15.5" r="2" stroke="white" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <span class="badge-pill bg-white text-dark">Minggu Ini</span>
                        </div>
                        <h4 class="fw-bold text-shadow-sm mb-1 text-white">Diskon Spesial Tanpa Ribet</h4>
                        <p class="opacity-90 mb-0 text-white">Pilih lapangan, lihat potongan harga, langsung booking. Simple!</p>
                    </div>
                </div>
            </div>

            {{-- Loop promo dari venue --}}
            @foreach ($venues as $venue)
                @php
                    /** @var \Illuminate\Support\Collection|null $promos */
                    $venuePromo = isset($promo) && $promo instanceof \Illuminate\Support\Collection
                        ? $promo->firstWhere('user_id', $venue->user_id)
                        : null;
                @endphp

                @if ($venuePromo)
                    <div class="col-12 col-md-6 col-xl-4">
                        <a href="{{ route('commerce.show', $venue->id) }}" class="text-decoration-none">
                            <div class="card rounded-5 shadow-soft card-raise position-relative"
                                 style="background:linear-gradient(135deg,#ef4444,#f59e0b); color:#fff;">
                                <div class="position-absolute w-100 h-100 pattern-dots" style="color:#fff;"></div>
                                <div class="card-body position-relative" style="z-index:1; padding:1.75rem;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5 class="fw-bold mb-0 line-1">{{ $venue->name }}</h5>
                                        <span class="badge-pill bg-white text-dark fw-bold">
                                            {{ number_format($venuePromo->diskon * 100, 0) }}%
                                        </span>
                                    </div>
                                    <p class="mb-2 opacity-90 line-2 text-white">{{ $venue->address }}</p>
                                    <div class="d-flex align-items-center mt-2">
                                        <span class="me-2">Booking sekarang</span>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                            <path d="M8 5l8 7-8 7" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
