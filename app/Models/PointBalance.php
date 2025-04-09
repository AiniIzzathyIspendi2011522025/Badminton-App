<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointBalance extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'point_balances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'point_balance',
        // Add other fillable attributes as needed
    ];

    /**
     * Get the customer that owns the point balance.
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
