<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityDetail extends Model
{
    use HasFactory;

    public function Venue()
    {
        return $this->hasOne(Venue::class, 'id', 'venue_id');
    }

    public function Facility()
    {
        return $this->hasOne(Facility::class, 'id', 'facility_id');
    }
}
