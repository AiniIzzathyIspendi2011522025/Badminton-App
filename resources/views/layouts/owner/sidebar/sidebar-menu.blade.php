<!-- Brand Logo -->
<a class="brand-link" style="background-color: #6FB6A6">
    <span class="brand-text font-weight-bold">Badminton</span>
</a>

<!-- Sidebar -->
<div class="sidebar" style="background-color: #6FB6A6">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img @if (Auth::user()->avatar == null) src="{{ asset('templates/img/user.png') }}"
            @else
            src="{{ asset('images/owner/' . Auth::user()->avatar) }}" @endif
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a style="color: white;" href="{{ route('owner.profil.index') }}" data-toggle="tooltip"
                data-placement="bottom" title="Profil Owner" class="d-block">
                <u><b> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></u> </a>
        </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a @if (Route::currentRouteName() == 'home.index') class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('home.index') }}">
                    <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                    <p style="color: white;">
                        Dashboard
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a @if (Route::currentRouteName() == 'owner.venue.index' ||
                        Route::currentRouteName() == 'owner.venue.edit' ||
                        Route::currentRouteName() == 'owner.venue.show' ||
                        Route::currentRouteName() == 'owner.venue.create' ||
                        Route::currentRouteName() == 'owner.venue.field.create' ||
                        Route::currentRouteName() == 'owner.field.edit' ||
                        Route::currentRouteName() == 'owner.venue.field-show') class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('owner.venue.index') }}">
                    <i class="nav-icon fas fa-columns" style="color: white;"></i>
                    <p style="color: white;">Kelola Lapangan</p>
                </a>
            </li>


            <li class="nav-item">
                <a @if (Route::currentRouteName() == 'owner.booking.index' || Route::currentRouteName() == 'owner.booking.show') class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('owner.booking.index') }}">
                    <i class="nav-icon fas fa-file" style="color: white;"></i>
                    <p style="color: white;">Booking</p>
                </a>
            </li>
            <li class="nav-item">
                <a @if (Route::currentRouteName() == 'owner.history.index' || Route::currentRouteName() == 'owner.history.show') class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('owner.history.index') }}" style="color: white;">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>History</p>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a @if (Route::currentRouteName() == 'owner.chat.index.owner') class="nav-link active" @else
                    class="nav-link" @endif href="{{ route('owner.chat.index.owner') }}" style="color: white;">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>Chat</p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a @if (Route::currentRouteName() == 'owner.membership.owner') class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('owner.membership.owner') }}" style="color: white;">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Membership</p>
                </a>
            </li>
            <li class="nav-item">
                <a @if (Route::currentRouteName() == 'owner.promo.index') class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('owner.promo.index') }}" style="color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="30" viewBox="0 0 576 512">
                        <path fill="#ffffff"
                            d="M64 64C28.7 64 0 92.7 0 128v64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320v64c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V320c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6V128c0-35.3-28.7-64-64-64H64zm64 112l0 160c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32H448c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V160z" />
                    </svg>
                    <p>Promo</p>
                </a>
            </li>
            <li class="nav-item">
                <a @if (Route::currentRouteName() == 'owner.report.index') class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('owner.report.index') }}" style="color: white;">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Transaksi</p>
                </a>
            </li>

        </ul>
    </nav>
    <nav class="mt-2" style="position:absolute; bottom:20px;background-color:green;color:white;border-radius:5px;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a class="nav-link" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <p> &ensp; Logout</p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
