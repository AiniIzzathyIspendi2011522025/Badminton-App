<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    public function Field()
    {
        return $this->hasOne(Field::class, 'id', 'field_id');
    }

    public function RentDetail()
    {
        return $this->hasMany(RentDetail::class, 'rent_id', 'id');
    }

    public function RentPayment()
    {
        return $this->hasOne(RentPayment::class, 'rent_id', 'id');
    }

    public function History()
    {
        return $this->hasOne(History::class, 'rent_id', 'id');
    }

    public function order($format)
    {
        $data = RentDetail::where('rent_id', $this->id)->orderby('id', $format)->first();
        $result = $data->OpeningHourDetail->OpeningHour->Hour->hour;

        return $result;
    }

    public function pointTransaction()
    {
        return $this->hasOne(PointTransaction::class);
    }
}
