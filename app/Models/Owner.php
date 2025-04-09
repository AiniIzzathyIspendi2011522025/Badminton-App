<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Promo()
    {
        return $this->hasMany(Promo::class, 'user_id', 'id');
    }
    public function Field()
    {
        return $this->hasMany(Field::class, 'owner_id', 'id');
    }
    public function Venue()
    {
        return $this->hasMany(Venue::class, 'owner_id', 'id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'owner_id', 'id');
    }
}
