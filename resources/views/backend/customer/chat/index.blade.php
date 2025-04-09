@extends('layouts.landing.home')

@section('css')
<style>
    .container {
        max-width: 1170px;
        margin: auto;
    }

    img {
        max-width: 100%;
    }

    .inbox_people {
        background: #f8f8f8 none repeat scroll 0 0;
        float: left;
        overflow: hidden;
        width: 40%;
        border-right: 1px solid #c4c4c4;
    }

    .inbox_msg {
        border: 1px solid #c4c4c4;
        clear: both;
        overflow: hidden;
    }

    .top_spac {
        margin: 20px 0 0;
    }


    .recent_heading {
        float: left;
        width: 40%;
    }

    .srch_bar {
        display: inline-block;
        text-align: right;
        width: 60%;
    }

    .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
    }

    .recent_heading h4 {
        color: #05728f;
        font-size: 21px;
        margin: auto;
    }

    .srch_bar input {
        border: 1px solid #cdcdcd;
        border-width: 0 0 1px 0;
        width: 80%;
        padding: 2px 0 4px 6px;
        background: none;
    }

    .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
    }

    .srch_bar .input-group-addon {
        margin: 0 0 0 -27px;
    }

    .chat_ib h5 {
        font-size: 15px;
        color: #464646;
        margin: 0 0 8px 0;
    }

    .chat_ib h5 span {
        font-size: 13px;
        float: right;
    }

    .chat_ib p {
        font-size: 14px;
        color: #989898;
        margin: auto
    }

    .chat_img {
        float: left;
        width: 11%;
    }

    .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 88%;
    }

    .chat_people {
        overflow: hidden;
        clear: both;
    }

    .chat_list {
        border-bottom: 1px solid #c4c4c4;
        margin: 0;
        padding: 18px 16px 10px;
    }

    .inbox_chat {
        height: 550px;
        overflow-y: scroll;
    }

    .active_chat {
        background: #ebebeb;
    }

    .incoming_msg_img {
        display: inline-block;
        width: 6%;
    }

    .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
    }

    .received_withd_msg p {
        background: #ebebeb none repeat scroll 0 0;
        border-radius: 3px;
        color: #646464;
        font-size: 14px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .received_withd_msg {
        width: 57%;
    }

    .mesgs {
        float: left;
        padding: 30px 15px 0 25px;
        width: 60%;
    }

    .sent_msg p {
        background: #05728f none repeat scroll 0 0;
        border-radius: 3px;
        font-size: 14px;
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .outgoing_msg {
        overflow: hidden;
        margin: 26px 0 26px;
    }

    .sent_msg {
        float: right;
        width: 46%;
    }

    .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
    }

    .type_msg {
        border-top: 1px solid #c4c4c4;
        position: relative;
    }

    .msg_send_btn {
        background: #05728f none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
    }

    .messaging {
        padding: 0 0 50px 0;
    }

    .msg_history {
        height: 516px;
        overflow-y: auto;
    }
</style>
@endsection
@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="page-content">
    <div class="container">
        <div class="row">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

            <div class="container">
                <h3 class=" text-center">{{$firstChat->Venue->name}}</h3>
                <div class="messaging">
                    <div class="inbox_msg">
                        <div class="inbox_people">
                            <div class="headind_srch">
                                <div class="recent_heading">
                                    <h4>Recent</h4>
                                </div>
                            </div>
                            <div class="inbox_chat">
                            @foreach ($chats as $chat)
                            @if ($chat->id == $firstChat->id)
                                <div class="chat_list active_chat">
                                    <div class="chat_people">
                                        <div class="chat_img"> <img @if ($chat->Owner->avatar == NULL)
                                            src="{{ asset('templates/img/user.png') }}" 
                                        @else
                                            src="{{asset('images/owner/'.$chat->Owner->avatar)}}" 
                                        @endif alt="sunil"  class="img-circle" width="100" height="50">
                                        </div>
                                        <div class="chat_ib">
                                            <a href="{{route('customer.chat.show', $chat->id)}}">
                                                <h5>{{$chat->Owner->first_name}} {{$chat->Owner->last_name}}
                                                <span class="chat_date">{{$chat->updated_at->format('H:i A, d M Y')}} 
                                                </span></h5>
                                            </a>
                                            <p>{{$chat->lastChat()->message}}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="chat_list">
                                    <div class="chat_people">
                                        <div class="chat_img"> <img @if ($chat->Owner->avatar == NULL)
                                            src="{{ asset('templates/img/user.png') }}" 
                                        @else
                                            src="{{asset('images/owner/'.$chat->Owner->avatar)}}" 
                                        @endif alt="sunil"  class="img-circle" width="100" height="50">
                                        </div>
                                        <div class="chat_ib">
                                        <a href="{{route('customer.chat.show', $chat->id)}}">
                                            <h5>{{$chat->Owner->first_name}} {{$chat->Owner->last_name}}
                                                <span class="chat_date">{{$chat->updated_at->format('H:i A, d M Y')}}
                                                </span>
                                            </h5>
                                        </a>
                                            <p>{{$chat->lastChat()->message}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                
                            @endforeach
                            </div>
                        </div>
                        <div class="mesgs">
                            <div class="msg_history">
                            @foreach ($firstChat->chatDetail as $chatDetail)
                                @if ($chatDetail->sender == Auth::user()->id)
                                <div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>{{$chatDetail->message}}</p>
                                        <span class="time_date">{{$chatDetail->created_at->format('H:i A | d M Y')}}</span>
                                    </div>
                                </div>
                                @else
                                <div class="incoming_msg">
                                    <div class="incoming_msg_img"> <img @if ($chatDetail->chat->Owner->avatar == NULL)
                                        src="{{ asset('templates/img/user.png') }}" 
                                    @else
                                        src="{{asset('images/owner/'.$chatDetail->Owner->avatar)}}"
                                    @endif
                                        alt="sunil" class="img-circle" width="100" height="50"> 
                                    </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p>{{$chatDetail->message}}</p>
                                            <span class="time_date">{{$chatDetail->created_at->format('H:i A | d M Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            </div>
                            <div class="type_msg">
                                <div class="input_msg_write">
                                    <input type="text" class="write_msg" placeholder="Type a message" />
                                    <button class="msg_send_btn" type="button" onclick="sendMessage({{$firstChat->Venue->id}}, {{Auth::user()->customer->id}}, {{$firstChat->Owner->id}}, {{Auth::user()->thisCustomer()}})">
                                        <i class="fa fa-paper-plane-o"  aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End .row -->
    </div><!-- End .container -->
</div>
@endsection

@section('script')
<script>
    function sendMessage(id, customer, owner, status) {
        let message = $('.write_msg').val();
        console.log(customer)
        let base_url = "{{URL('api/message/send_message')}}";
        $.ajax({

            url: base_url + "?customer=" + customer + "&owner=" + owner + "&id=" + id + "&message=" + message + "&status=" + status,
            dataType: 'json',
            cache: false,
            dataSrc: '',
            success: function (data) {
                var div = $(`<div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>`+message+`</p>
                                        <span class="time_date">`+data.created_at+`</span>
                                    </div>
                                </div>`)

                $('.msg_history').append(div);
            }
        });
    }
</script>
@endsection