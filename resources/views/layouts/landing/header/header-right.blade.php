<div class="header-right">
    <div class="header-search header-search-extended header-search-visible header-search-no-radius d-block">
        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
        <form action="{{ route('landing.find') }}" method="post">
            @csrf
            <div class="header-search-wrapper search-wrapper-wide">
                <label for="q" class="sr-only">Search</label>
                <input type="search" class="form-control" name="find" id="find" placeholder="Cari Lapangan ..."
                    required>
                <button class="btn" type="submit"><i class="icon-search"></i></button>
            </div><!-- End .header-search-wrapper -->
        </form>

    </div><!-- End .header-search -->
    <div class="dropdown cart-dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" data-display="static">
        </a>
        @if (Auth::user())
            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" data-display="static">
                <i class="icon-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-cart-action">
                    <a href="{{ route('customer.profil.index') }}" class="btn btn-primary">Profil</a>
                    <a onclick="logout()" href="#" class="btn btn-outline-primary-2"><span>Logout</span><i
                            class="icon-long-arrow-right"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                    </a>
                </div><!-- End .dropdown-cart-total -->
            </div><!-- End .dropdown-menu -->
        @else
            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" data-display="static">
                <i class="icon-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <p>Login</p>
                <div class="dropdown-cart-action">
                    <a href="{{ route('login') }}?role=owner" class="btn btn-primary mr-1">Pemilik</a>
                    <a href="{{ route('login') }}?role=customer" class="btn btn-primary">Penyewa</a>
                </div><!-- End .dropdown-cart-total -->
            </div><!-- End .dropdown-menu -->
        @endif
    </div><!-- End .cart-dropdown -->
</div>
