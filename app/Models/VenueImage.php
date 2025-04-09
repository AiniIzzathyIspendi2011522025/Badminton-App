<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueImage extends Model
{
    use HasFactory;

    public function Venue()
    {
        return $this->hasOne(Venue::class, 'id', 'venue_id');
    }
}
