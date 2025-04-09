<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    public function Owner()
    {
        return $this->hasOne(Owner::class, 'id', 'owner_id');
    }

    public function Customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function Venue()
    {
        return $this->hasOne(Venue::class, 'id', 'venue_id');
    }

    public function chatDetail()
    {
        return $this->hasMany(ChatDetail::class, 'chat_id', 'id');
    }

    public function lastChat()
    {
        $result = ChatDetail::where('chat_id', $this->id)->orderby('created_at', 'desc')->first();
        return $result;
    }

    public function newMessage(){
        $result = ChatDetail::where('chat_id', $this->id)
                            ->where('receiver', Auth::user()->id)
                            ->orderby('created_at', 'desc')
                            ->first();
        return $result;
    }
}
