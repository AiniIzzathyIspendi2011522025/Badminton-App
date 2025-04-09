<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function FacilityDetail()
    {
        return $this->hasMany(FacilityDetail::class, 'facility_id', 'id');
    }
}
