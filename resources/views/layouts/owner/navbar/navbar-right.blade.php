<ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
    </li>
    <?php
    $venues = \App\Models\Venue::select('id')
        ->where('user_id', Auth::user()->id)
        ->get();
    
    $venue_id = collect([]);
    foreach ($venues as $venue) {
        $venue_id->push($venue->id);
    }
    // $chats = \App\Models\Chat::whereIn('venue_id', $venue_id)
    //                         ->where('owner_status', 0)
    //                         ->get();
    ?>
    <!-- Messages Dropdown Menu -->
    {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          @if ($chats->count() > 0)
          <span class="badge badge-danger navbar-badge">{{$chats->count()}}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @if ($chats->count() > 0)
          @foreach ($chats as $chat)
            <a href="{{ route('owner.chat.show', $chat->id) }}" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img @if ($chat->Customer->avatar == null)
                        src="{{ asset('templates/img/user.png') }}"
                    @else
                        src="{{asset('images/customer/'.$chat->Customer->avatar)}}"
                    @endif
                alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    {{$chat->customer->first_name}} {{$chat->customer->last_name}}
                  </h3>

                  <p class="text-sm">Ada pesan baru untuk <b class="text-sm text-danger">{{$chat->Venue->name}}</b></p>
                  <small class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{$chat->newMessage()->created_at->format('H:i')}} - {{$chat->newMessage()->created_at->format('d-m-Y')}}</small>
                  <p class="text-sm"><b class="text-sm text-danger">{{Helper::timeago($chat->newMessage()->created_at)}}</b></p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
          @endforeach
            <a  href="{{ route('owner.chat.index.owner') }}" class="dropdown-item dropdown-footer">Lihat semua pesan</a>
          @else
            <a class="dropdown-item dropdown-footer">Tidak memiliki pesan baru</a>
          @endif
        </div>
      </li> --}}
    <!-- Notifications Dropdown Menu -->
    <?php
    $fields = App\Models\Field::whereIn('venue_id', $venue_id)->get();
    
    $field_id = collect([]);
    foreach ($fields as $field) {
        $field_id->push($field->id);
    }
    
    $rents = App\Models\Rent::whereIn('field_id', $field_id)->where('status', 1)->get();
    
    $rent_id = collect([]);
    foreach ($rents as $rent) {
        $rent_id->push($rent->id);
    }
    
    $rentPayments = App\Models\RentPayment::whereIn('rent_id', $rent_id)->get();
    $rentPaymentsLast = App\Models\RentPayment::whereIn('rent_id', $rent_id)->orderby('created_at', 'desc')->first();
    ?>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if ($rentPayments->count() > 0)
                <span class="badge badge-warning navbar-badge">{{ $rentPayments->count() }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ $rentPayments->count() }} Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="{{ route('owner.booking.index') }}" class="dropdown-item">
                <!-- Message Start -->
                @if ($rentPayments->count() > 0)
                    <div class="media">
                        <i class="fas fa-cart-arrow-down mr-2" style='font-size:25px;color:red'></i>
                        <div class="media-body">
                            <p class="text-sm">{{ $rentPayments->count() }} permintaan konfirmasi<b
                                    class="text-sm text-danger"> Pembayaran Booking</b></p>
                            <span
                                class="float-right text-muted text-sm">{{ Helper::timeago($rentPaymentsLast->created_at) }}</span>
                        </div>
                    </div>
                @endif
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
</ul>
