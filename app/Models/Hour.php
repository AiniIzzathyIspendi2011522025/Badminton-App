<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    use HasFactory;

    public function OpeningHour()
    {
        return $this->hasMany(OpeningHour::class, 'hour_id', 'id');
    }

    public function checkOpeningHour($venue_id, $day_id, $hour_id)
    {
        $openingHour = OpeningHour::where('venue_id', $venue_id)
                                    ->where('day_id', $day_id)
                                    ->where('hour_id', $hour_id)
                                    ->first();
        
        if($openingHour->status == 2){
            return true;
        }else{
            return false;
        }
    }
}
