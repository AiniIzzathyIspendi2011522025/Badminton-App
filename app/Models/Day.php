<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function OpeningHour()
    {
        return $this->hasMany(OpeningHour::class, 'day_id', 'id');
    }

    public function checkOpeningHour($venue_id, $day_id)
    {
        $openingHour = OpeningHour::where('venue_id', $venue_id)
                                    ->where('day_id', $day_id)
                                    ->where('status', 2)
                                    ->get();
        
        if($openingHour->count() > 0){
            return true;
        }else{
            return false;
        }
    }
}
