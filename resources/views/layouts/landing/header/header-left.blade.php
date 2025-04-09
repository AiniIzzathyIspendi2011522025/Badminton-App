<div class="header-left">
    {{-- <button class="mobile-menu-toggler">
        <span class="sr-only">Toggle mobile menu</span>
        <i class="icon-bars"></i>
    </button> --}}


    <a href="/" class="logo">
        <img src="{{ asset('templates/img/logo-removebg-preview.png') }}" alt="Badminton Logo" width="50"
            height="25">
    </a>
    {{-- <div style="margin:20px;">
        <h3>Badminton</h3>
    </div> --}}
    <nav class="d-block d-lg-none">
        @if (Auth::user())
            <ul class="d-flex justify-content-between text-xl">
                {{-- <li @if (Route::currentRouteName() == 'landing.index') class="px-2" @else class="px-2" @endif>
                    <a href="{{ route('landing.index') }}" class="text-dark text-xl">Home</a>
                </li> --}}
                {{-- <li  @if (Route::currentRouteName() == 'customer.commerce.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                        <a href="{{ route('customer.commerce.index') }}">Cari Lapangan</a>
                    </li> --}}
                <li @if (Route::currentRouteName() == 'customer.booking.index') class="active px-2" @else class="megamenu-container px-2" @endif>
                    <a href="{{ route('customer.booking.index') }}" class="text-dark text-xl">Booking</a>
                </li>
                <li @if (Route::currentRouteName() == 'customer.history.index') class="active px-2" @else class="megamenu-container px-2" @endif>
                    <a href="{{ route('customer.history.index') }}" class="text-dark text-xl">History</a>
                </li>
                {{-- <li @if (Route::currentRouteName() == 'customer.profil.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                        <a href="{{ route('customer.profil.index') }}">Profil</a>
                    </li> --}}
                {{-- <li @if (Route::currentRouteName() == 'customer.chat.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                        <a href="{{ route('customer.chat.index') }}">Chat</a>
                    </li> --}}
            </ul><!-- End .menu -->
        @else
            <center>
                <ul>
                    <li
                        @if (Route::currentRouteName() == 'landing.index') class="active px-2" @else class="megamenu-container px-2" @endif>
                        <a href="{{ route('landing.index') }}" class="text-dark text-xl">Home</a>
                    </li>
                    {{-- <li  @if (Route::currentRouteName() == 'commerce.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                        <a href="{{ route('commerce.index') }}">Cari Lapangan</a>
                    </li> --}}
                </ul><!-- End .menu -->
            </center>
        @endif
    </nav><!-- End .main-nav -->
</div>
