<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public function PaymentMethodDetail()
    {
        return $this->hasMany(PaymentMethodDetail::class, 'payment_method_id', 'id');
    }

    public function isChecked($venue_id){
        $result = PaymentMethodDetail::where('payment_method_id', $this->id)
                                        ->where('venue_id', $venue_id)
                                        ->first();

        return $result;
    }
}
