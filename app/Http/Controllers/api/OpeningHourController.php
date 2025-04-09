<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\OpeningHour;
use App\Models\OpeningHourDetail;

class OpeningHourController extends Controller
{
    public function getData(Request $request)
    {
        $data = [];
        $data = OpeningHour::select('opening_hours.hour_id', 'hours.hour','opening_hours.status','opening_hours.day_id')
        ->where('venue_id', $request->venue_id)
        ->where('day_id', $request->day_id)
        ->join('hours', 'opening_hours.hour_id', '=', 'hours.id')->get();
        return response()->json($data);
    }
    public function getDay(Request $request)
    {
        $data = [];
        $data = Day::find($request->day_id);
        return response()->json($data);
    }
    public function storeData(Request $request)
    {
        foreach($request->hour as $hour){
            $data = new OpeningHourDetail;
            $data->hour_id = $hour;
            $data->day_id = $request->day_id;
            $data->venue_id = $id;
            $data->save();
        }
        return json_encode(array('statusCode'=>200));
    }
}
