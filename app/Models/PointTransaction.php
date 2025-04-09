<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'point_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'transaction_id',
        'point_earned',
        'point_spent',
        'transaction_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    /**
     * Get the customer associated with the point transaction.
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transaction associated with the point transaction.
     */
    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }
}
