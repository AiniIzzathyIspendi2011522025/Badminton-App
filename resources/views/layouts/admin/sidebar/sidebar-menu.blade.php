<!-- Brand Logo -->
<a class="brand-link" style="background-color: #6FB6A6; color: white;">
    <span class="brand-text font-weight-bold">Badminton</span>
</a>

<!-- Sidebar -->
<div class="sidebar" style="background-color: #6FB6A6">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('templates/img/user.png') }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a style="color:white;" data-toggle="tooltip" data-placement="bottom" title="Profil Owner" class="d-block">
            <u><b>Admin</b></u> </a>
        </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a @if(Route::currentRouteName()=="home.index" ) class="nav-link bg-info" @else class="nav-link" @endif
                    href="{{ route('home.index') }}" style="color: white">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li @if(Route::currentRouteName()=="admin.admin.index" || Route::currentRouteName()=="admin.admin.edit" ||
                Route::currentRouteName()=="admin.admin.create" || Route::currentRouteName()=="admin.owner.index" ||
                Route::currentRouteName()=="admin.owner.create" || Route::currentRouteName()=="admin.owner.edit" ||
                Route::currentRouteName()=="admin.customer.index" || Route::currentRouteName()=="admin.customer.create"
                || Route::currentRouteName()=="admin.customer.edit" ) class="nav-item menu-open" @else class="nav-item"
                @endif>
                <a @if(Route::currentRouteName()=="admin.admin.index" || Route::currentRouteName()=="admin.admin.edit"
                    || Route::currentRouteName()=="admin.admin.create" || Route::currentRouteName()=="admin.owner.index"
                    || Route::currentRouteName()=="admin.owner.create" || Route::currentRouteName()=="admin.owner.edit"
                    || Route::currentRouteName()=="admin.customer.index" ||
                    Route::currentRouteName()=="admin.customer.create" ||
                    Route::currentRouteName()=="admin.customer.edit" ) class="nav-link bg-info" @else class="nav-link"
                    @endif href="#" style="color: white;">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Pengguna
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()=="admin.admin.index" ||
                            Route::currentRouteName()=="admin.admin.edit" ||
                            Route::currentRouteName()=="admin.admin.create" ) class="nav-link bg-success" @else
                            class="nav-link" @endif href="{{ route('admin.admin.index') }}" style="color: white;">
                            <i class="far fa-circle nav-icon" style="color: white;"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()=="admin.owner.index" ||
                            Route::currentRouteName()=="admin.owner.create" ||
                            Route::currentRouteName()=="admin.owner.edit" ) class="nav-link bg-success" @else
                            class="nav-link" @endif href="{{ route('admin.owner.index') }}" style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pemilik Lapangan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()=="admin.customer.index" ||
                            Route::currentRouteName()=="admin.customer.create" ||
                            Route::currentRouteName()=="admin.customer.edit" ) class="nav-link bg-success" @else
                            class="nav-link" @endif href="{{ route('admin.customer.index') }}" style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Penyewa Lapangan</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li @if(Route::currentRouteName()=="admin.venue.index.admin" ||
                Route::currentRouteName()=="admin.venue.show-index" ||
                Route::currentRouteName()=="admin.venue.index1.admin" ||
                Route::currentRouteName()=="admin.venue.show1-index" ||
                Route::currentRouteName()=="admin.venue.index2.admin" ||
                Route::currentRouteName()=="admin.venue.show2-index" ) class="nav-item menu-open" @else class="nav-item"
                @endif>
                <a @if(Route::currentRouteName()=="admin.venue.index.admin" ||
                    Route::currentRouteName()=="admin.venue.show-index" ||
                    Route::currentRouteName()=="admin.venue.index1.admin" ||
                    Route::currentRouteName()=="admin.venue.show1-index" ||
                    Route::currentRouteName()=="admin.venue.index2.admin" ||
                    Route::currentRouteName()=="admin.venue.show2-index" ) class="nav-link bg-info" @else
                    class="nav-link" @endif href="#" class="nav-link" style="color: white;">
                    <i class="nav-icon fas fa-columns"></i>
                    <p>
                        Lapangan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()=="admin.venue.index.admin" ||
                            Route::currentRouteName()=="admin.venue.show-index" ) class="nav-link bg-success" @else
                            class="nav-link" @endif href="{{ route('admin.venue.index.admin') }} " style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Perlu Konfirmasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()=="admin.venue.index2.admin" ||
                            Route::currentRouteName()=="admin.venue.show2-index" ) class="nav-link bg-success" @else
                            class="nav-link" @endif href="{{ route('admin.venue.index2.admin') }} " style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ditolak</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()=="admin.venue.index1.admin" ||
                            Route::currentRouteName()=="admin.venue.show1-index" ) class="nav-link bg-success" @else
                            class="nav-link" @endif href="{{ route('admin.venue.index1.admin') }}" style="color: white;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dikonfirmasi</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li @if(Route::currentRouteName()=="admin.field-type.index" ) class="nav-item menu-open" @else class="nav-item"
                @endif>
                <a @if(Route::currentRouteName()=="admin.field-type.index" ) class="nav-link bg-info" @else class="nav-link"
                    @endif href="{{ route('admin.field-type.index') }}" style="color: white;">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Tipe Lapangan
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <nav class="mt-2" style="position:absolute; bottom:20px;background-color:green;color:white;border-radius:5px;">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
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
