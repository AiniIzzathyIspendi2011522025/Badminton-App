<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = "memberships";
    protected $guarded = [];
    use HasFactory;

    public $incrementing = false;   // <— WAJIB
    protected $keyType = 'string';  // <— WAJIB

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
