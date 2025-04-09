<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentDetail extends Model
{
    use HasFactory;

    public function Rent()
    {
        return $this->hasOne(Rent::class, 'id', 'rent_id');
    }

    public function OpeningHourDetail()
    {
        return $this->hasOne(OpeningHourDetail::class, 'id', 'opening_hour_detail_id');
    }

}
