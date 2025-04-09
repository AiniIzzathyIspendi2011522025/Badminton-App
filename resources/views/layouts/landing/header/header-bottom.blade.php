<div class="container ">
    <div class="row" style="background-color: #0D13A1">
        <div class=" text-center ">
            <nav class="main-nav">
                @if (Auth::user())
                    <ul class="menu sf-arrows">
                        <li
                            @if (Route::currentRouteName() == 'landing.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                            <a href="{{ route('landing.index') }}">Home</a>
                        </li>
                        {{-- <li  @if (Route::currentRouteName() == 'customer.commerce.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                        <a href="{{ route('customer.commerce.index') }}">Cari Lapangan</a>
                    </li> --}}
                        <li
                            @if (Route::currentRouteName() == 'customer.booking.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                            <a href="{{ route('customer.booking.index') }}">Booking</a>
                        </li>
                        <li
                            @if (Route::currentRouteName() == 'customer.history.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                            <a href="{{ route('customer.history.index') }}">History</a>
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
                        <ul class="menu sf-arrows">
                            <li
                                @if (Route::currentRouteName() == 'landing.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                                <a href="{{ route('landing.index') }}">Home</a>
                            </li>
                            {{-- <li  @if (Route::currentRouteName() == 'commerce.index') class="megamenu-container active" @else class="megamenu-container" @endif>
                        <a href="{{ route('commerce.index') }}">Cari Lapangan</a>
                    </li> --}}
                        </ul><!-- End .menu -->
                    </center>
                @endif
            </nav><!-- End .main-nav -->

        </div><!-- End .col-lg-9 -->
    </div><!-- End .row -->
</div>
