<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venue;
use App\Models\OpeningHourDetail;
class PricingController extends Controller
{
    public function setPrice(Request $request)
    {
        $price = 0;
        $dp = 0;
        if($request->id)
        {
            $details = OpeningHourDetail::whereIn('id', $request->id)->get();
            foreach($details as $detail)
            {
                $price = $price + $detail->price;
            }
            if($request->status == 2)
            {
                $venue = Venue::find($request->venue_id);
                $dp_percentage = $venue->dp_percentage;
                $dp = $price * $dp_percentage / 100;
            }
        }
        $data = 
        [
            "price" => $price,
            "dp" => $dp
        ];
        return response()->json($data);
    }
}
