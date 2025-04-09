@extends('layouts.owner.home')

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Lapangan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('owner.venue.index') }}"> Lapangan</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('owner.venue.show', $fields->Venue->id) }}">Kelola
                            Lapangan</a></li>
                    <li class="breadcrumb-item active">Detail Lapangan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $fields->name }}</h4>
                            </div>
                            <div class="card-body">
                                <span>Tipe Lapangan : <b>{{ $fields->FieldType->name }}</b><br>
                                </span><br>
                                <div data-crop-image="285">
                                    <img alt="image" src="{{ asset('images/field/'.$fields->image) }}"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" id="jadwal">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Jadwal dan Biaya {{ $fields->name }}</h4>
                                <a href="{{route('owner.venue.fieldScheduleEdit', $fields->id)}}" class="btn btn-warning btn-sm" style="float:right;margin-left:5px;">Ubah</a>
                            </div>
                            <div class="card-body">
                                <div id="accordion">
                                    @foreach ($fields->Venue->groupDay() as $groupDay)
                                    <div class="accordion">
                                        <div style="background-color:#C0C0C0; padding:0px 5px 0px 5px; border-radius:5px;"
                                            class="accordion-header" role="button" data-toggle="collapse"
                                            data-target="#panel-body-{{$loop->iteration}}">
                                            <p><i class='fas fa-angle-down'></i> &ensp;<b>{{$groupDay->Day->name}}</b>
                                            </p>
                                        </div>
                                        <div class="accordion-body collapse" id="panel-body-{{$loop->iteration}}"
                                            data-parent="#accordion">
                                            <p class="mb-0">
                                                <div class="badges">
                                                    @foreach($fields->Venue->perDay($groupDay->day_id) as $open)
                                                    @if($open->status == 2)
                                                    <span class="badge badge-secondary"
                                                        style="padding:15px 20px;margin:5px;">
                                                        {{ $open->hour->hour }} <br><br>
                                                        @if($open->priceDetail($fields->id))
                                                        {{ $open->priceDetail($fields->id)->price / 1000 }}K
                                                        @endif
                                                    </span>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script type="text/javascript">




</script>

@endsection
