<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'latitude',
        'longitude',
        'user_id'
    ];
    public function Owner()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function Field()
    {
        return $this->hasMany(Field::class, 'venue_id', 'id');
    }
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
    public function rangePrice($status)
    {
        $fields = Field::where('venue_id', $this->id)->get();
        $field_id = collect([]);
        foreach ($fields as $field) {
            $field_id->push($field->id);
        }
        return OpeningHourDetail::select('price')->whereIn('field_id', $field_id)->orderby('price', $status)->first();
    }
    public function FacilityDetail()
    {
        return $this->hasMany(FacilityDetail::class, 'venue_id', 'id');
    }

    public function OtherFacility()
    {
        return $this->hasMany(OtherFacility::class, 'venue_id', 'id');
    }

    public function ActiveFacilityDetail()
    {
        $result = FacilityDetail::where('venue_id', $this->id)->where('status', 2)->get();
        return $result;
    }
    public function VenueImage()
    {
        return $this->hasMany(VenueImage::class, 'venue_id', 'id');
    }
    public function FirstImage()
    {
        return VenueImage::inRandomOrder()->where('venue_id', $this->id)->first();
    }
    public function OpeningHour()
    {
        return $this->hasMany(OpeningHour::class, 'venue_id', 'id');
    }
    public function paymentMethodDetail()
    {
        return $this->hasMany(PaymentMethodDetail::class, 'venue_id', 'id');
    }
    public function perDay($day)
    {
        $data = OpeningHour::where('venue_id', $this->id)->where('day_id', $day)->get();
        return $data;
    }
    public function groupDay()
    {
        $data = OpeningHour::select('day_id')->where('venue_id', $this->id)->groupBy('day_id')->get();
        return $data;
    }
}
