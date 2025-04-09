<?php namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\Owner;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MessageController extends Controller {
    public function sendMessage(Request $request) {
        $chat=Chat::where('customer_id', $request->customer)
        ->where('owner_id', $request->owner)
        ->where('venue_id', $request->id)->first();

        $owner = Owner::find($request->owner);
        $customer = Customer::find($request->customer);
        if($chat) {
            $chatDetail=new ChatDetail;
            $chatDetail->chat_id=$chat->id;
            if($request->status) {
                $chatDetail->sender=$customer->User->id;
                $chatDetail->receiver=$owner->User->id;
            }else {
                $chatDetail->sender=$owner->User->id;
                $chatDetail->receiver=$customer->User->id;
            }
            $chatDetail->message=$request->message;
            $chatDetail->save();
            $today=Carbon::now();
            $chat->updated_at=$today->format('Y-m-d H:i:s');
            $chat->save();
        }
        else {
            $chat=new Chat;
            $chat->owner_id=$request->owner;
            $chat->customer_id=$request->customer;
            $chat->venue_id=$request->id;
            $chat->save();
            $chatDetail=new ChatDetail;
            $chatDetail->chat_id=$chat->id;
            if($request->status) {
                $chatDetail->sender=$customer->User->id;
                $chatDetail->receiver=$owner->User->id;
            }else {
                $chatDetail->sender=$owner->User->id;
                $chatDetail->receiver=$customer->User->id;
            }
            $chatDetail->message=$request->message;
            $chatDetail->save();
        }
        $data=[ "name"=>$chatDetail->Customer->first_name." ".$chatDetail->Customer->last_name,
        "avatar"=>$chatDetail->Customer->avatar,
        "message"=>$request->message,
        "created_at"=>$chatDetail->created_at->format('H:i A | d M Y'),
        "created_atV2"=>$chatDetail->created_at->format('D M d Y - H:i:s')];
        return response()->json($data);
    }
}