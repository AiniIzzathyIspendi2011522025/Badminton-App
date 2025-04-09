<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class OpeningHour extends Model
{
    use HasFactory;

    public function Venue()
    {
        return $this->hasOne(Venue::class, 'id', 'venue_id');
    }

    public function Day()
    {
        return $this->hasOne(Day::class, 'id', 'day_id');
    }

    public function Hour()
    {
        return $this->hasOne(Hour::class, 'id', 'hour_id');
    }

    public function OpeningHourDetail()
    {
        return $this->hasMany(OpeningHourDetail::class, 'opening_hour_id', 'id');
    }

    public function priceDetail($id)
    {
        $data = OpeningHourDetail::where('opening_hour_id', $this->id)->where('field_id', $id)->first();
        return $data;
    }

    public function checked($field_id){
        return OpeningHourDetail::where('field_id', $field_id)->where('opening_hour_id', $this->id)->first();
    }

    public function checkAvailable(){
        $fields = Field::where('venue_id',$this->venue_id)->get();
        $field_id = collect([]);
        foreach($fields as $row){
            $field_id->push($row->id);
        }
        $openingHourDetails = OpeningHourDetail::where('opening_hour_id', $this->id)->whereIn('field_id', $field_id)->get();
        $opening_detail_id = collect([]);
        foreach($openingHourDetails as $openingHourDetail){
            $opening_detail_id->push($openingHourDetail->id);
        }

        $rents = Rent::where(DB::raw('date_format(date, "%Y-%m-%d")'), Carbon::now()->format('Y-m-d'))->whereIn('field_id', $field_id)->get();
        $rent_id = collect([]);
        foreach($rents as $rent){
            $rent_id->push($rent->id);
        }

        $details = RentDetail::whereIn('rent_id', $rent_id)->whereIn('opening_hour_detail_id', $opening_detail_id)->get();

        if($openingHourDetails->count() == $details->count()){
            return false;
        }else{
            return true;
        }
    }

    
}
