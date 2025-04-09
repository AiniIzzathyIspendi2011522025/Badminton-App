<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningHourDetail extends Model
{
    use HasFactory;

    public function Field()
    {
        return $this->hasOne(Field::class, 'id', 'field_id');
    }

    public function OpeningHour()
    {
        return $this->hasOne(OpeningHour::class, 'id', 'opening_hour_id');
    }

    public function day($id, $val)
    {
        $day = Day::where('slug', $val)->first();
        return OpeningHour::where('venue_id',$id)->where('day_id', $day->id)->get();
    }

}
