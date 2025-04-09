<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodDetail extends Model
{
    use HasFactory;

    public function Venue()
    {
        return $this->hasOne(Venue::class, 'id', 'venue_id');
    }

    public function PaymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }

    public function RentPayment()
    {
        return $this->hasMany(RentPayment::class, 'id', 'rent_id', 'id');
    }
}
