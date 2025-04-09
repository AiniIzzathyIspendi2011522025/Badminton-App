@extends('layouts.owner.home')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Owner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Profil Owner</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach ($owners as $owner)
                                <div class="text-center">
                                    <img @if ($owner->avatar == null) src="{{ asset('templates/img/user.png') }}"
                            @else
                            src="{{ asset('images/owner/' . $owner->avatar) }}" @endif
                                        class="profile-user-img img-fluid img-circle" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{ $owner->first_name }} {{ $owner->last_name }}
                                </h3>
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                                <p class="text-muted">{{ $owner->address }}</p>
                                <strong><i class="fas fa-phone-alt mr-1"></i> No Handphone</strong>
                                <p class="text-muted">{{ $owner->handphone }} </p>
                                <strong><i class="fas fa-envelope"></i> E-mail</strong>
                                <p class="text-muted">{{ $owner->email }}</p>
                                <strong><i class="fas fa-money-check"></i> KTP</strong>
                                <figure>
                                    <center>
                                        @if ($owner->ktp == null)
                                            <img src="{{ asset('templates/img/credit-card.png') }}" alt="ktp"
                                                style="width:90%;height:200px;">
                                            <figcaption>Belum input KTP</figcaption>
                                        @else
                                            <img src="{{ asset('images/ktp/' . $owner->ktp) }}" alt="ktp"
                                                style="width:90%;height:200px;">
                                            <figcaption>Telah input KTP</figcaption>
                                        @endif
                                    </center>
                                </figure>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                @include('backend.owner.manage_profil.edit')
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                @include('auth.passwords.change')
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    {!! Form::open([
        'method' => 'GET',
        'route' => ['owner.profil.edit', 0],
        'style' => 'display.none',
        'id' => 'edit_profil',
    ]) !!}
    {!! Form::close() !!}
@endsection

@section('script')
    <script>
        function edit(id) {
            $('#edit_profil').attr('action', "{{ route('owner.profil.index') }}/" + id + "/edit");
            $('#edit_profil').submit();
        }
    </script>
@endsection
