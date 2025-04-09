<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'venue_id',
        'field_type_id'
    ];

    public function Venue()
    {
        return $this->hasOne(Venue::class, 'id', 'venue_id');
    }

    public function FieldType()
    {
        return $this->belongsTo(FieldType::class, 'field_type_id');
	}

    public function OpeningHourDetail()
    {
        return $this->hasMany(OpeningHourDetail::class, 'field_id', 'id');
    }

}
