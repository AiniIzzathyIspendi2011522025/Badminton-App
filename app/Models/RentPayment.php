<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPayment extends Model
{
    use HasFactory;

    public function Rent()
    {
        return $this->hasOne(Rent::class, 'id', 'rent_id');
    }

    public function PaymentMethodDetail()
    {
        return $this->hasOne(PaymentMethodDetail::class, 'id', 'payment_method_detail_id');
    }


}
