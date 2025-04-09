<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Venue;
use App\Models\VenueImage;
use App\Models\Field;
use App\Models\Owner;
use App\Models\Customer;
use App\Models\Day;
use App\Models\Hour;
use App\Models\OpeningHour;
use App\Models\OpeningHourDetail;
use App\Models\Facility;
use App\Models\FacilityDetail;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodDetail;
use Faker\Generator as Faker;
use DB;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = User::Factory(10)
            ->has(Admin::Factory()->count(1), 'admin')
            ->create();
        $venue = Venue::factory(4)->create([
            'owner_id' => 1,
        ]);
        for($i=1; $i<=4; $i++){
            $field = Field::factory(3)->create([
                'venue_id' => $i,
            ]);
        }
        $user = User::factory(10)
            ->has(Owner::factory()->count(1)
                    ->has(Venue::factory()->count(4)
                            ->has(Field::factory()->count(2)
                            ->state(function (array $attributes, Venue $venue){
                                $field_name = [
                                    'Lapangan A',
                                    'Lapangan B',
                                    'Lapangan C',
                                    'Lapangan D',
                                    'Lapangan E'
                                ];
                                $random_number = rand(0,4);
                                $field = Field::where('venue_id', $venue->id)->where('name', $field_name[$random_number])->first();
                                while($field){
                                    $random_number = rand(0,4);
                                    $field = Field::where('venue_id', $venue->id)->where('name', $field_name[$random_number])->first();
                                }
                                return ['name' => $field_name[$random_number]];
                            })

                            , 'field')
                        , 'venue')
            , 'owner')
            ->create();
        $user = User::Factory(10)
            ->has(Customer::Factory()->count(1), 'customer')
            ->create();

        $venues = Venue::all();
        foreach($venues as $venue)
        {
            $facilities = Facility::all();
            foreach($facilities as $facility){
                $facilityDetail = new FacilityDetail;
                $facilityDetail->venue_id = $venue->id;
                $facilityDetail->facility_id = $facility->id;
                $facilityDetail->status = rand(1,2);
                $facilityDetail->save();
            }

            $n = rand(3,5);
            for($i=0; $i<$n; $i++){
                $venueImage = new VenueImage;
                $venueImage->venue_id = $venue->id;
                $venueImage->image = 'venue_'.(string) rand(1,60).'.jpg';
                $venueImage->save();
            }

            $start_collection = [7.00, 7.30];
            $start = $start_collection[rand(0,1)];
            $id = collect([]);
            if($start == 7.00){
                for($i=0; $i<48; $i++){
                    if($i%2==1){
                        $id->push($i);
                    }
                }
            }else{
                for($i=0; $i<48; $i++){
                    if($i%2==0){
                        $id->push($i);
                    }
                }
            }
            $hours = Hour::where(DB::raw("cast(hour as decimal(10,2))"), '>=', $start)
                                ->whereIn('id', $id)
                                ->get();
            $fields = Field::where('venue_id', $venue->id)->get();

            $price = [90000, 95000, 100000, 115000, 120000];
            $let_open = 1;
            for($day=1; $day<=7; $day++)
            {
                $open = rand(1,2);
                if($open == 1){
                    $this_price = $price[rand(0,4)];
                    $first_price = $this_price;

                    $allHours = Hour::all();
                    foreach($allHours as $allHour)
                    {
                        $openingHour = new OpeningHour;
                        $openingHour->venue_id = $venue->id;
                        $openingHour->day_id = $day;
                        $openingHour->hour_id = $allHour->id;
                        $openingHour->save();
                    }
                    foreach($hours as $hour)
                    {
                        $openingHour = OpeningHour::where('venue_id', $venue->id)
                                                    ->where('day_id', $day)
                                                    ->where('hour_id', $hour->id)
                                                    ->first();
                        $openingHour->status = 2;
                        $openingHour->save();

                        foreach($fields as $field)
                        {
                            if($hour->id > 27)
                            {
                                $this_price = $first_price + 10000;
                            }
                            $detail = new OpeningHourDetail;
                            $detail->field_id = $field->id;
                            $detail->opening_hour_id = $openingHour->id;
                            $detail->price = $this_price;
                            $detail->save();
                        }
                    }
                    $let_open = $let_open + 1;
                }
            }

            $paymentMethod = PaymentMethod::all();
            for($i=1; $i <= rand(1,3); $i++)
            {
                $rand_number = rand(1, $paymentMethod->count());
                $paymentMethodDetail = PaymentMethodDetail::where('venue_id', $venue->id)
                                                            ->where('payment_method_id', $rand_number)
                                                            ->first();
                while($paymentMethodDetail)
                {
                    $rand_number = rand(1, $paymentMethod->count());
                    $paymentMethodDetail = PaymentMethodDetail::where('venue_id', $venue->id)
                                                                ->where('payment_method_id', $rand_number)
                                                                ->first();
                }

                $paymentMethodDetail = new PaymentMethodDetail;
                $paymentMethodDetail->venue_id = $venue->id;
                $paymentMethodDetail->payment_method_id = $rand_number;
                $paymentMethodDetail->no_rek = $faker->creditCardNumber();
                $paymentMethodDetail->save();
            }


        }
    }
}