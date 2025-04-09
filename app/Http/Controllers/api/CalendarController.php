<?php namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Field;
use App\Models\Rent;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function getCalendar(Request $request){
        $venues = Venue::where('user_id', $request->id)->where('status', 1)->get();
        $field_id = collect([]);
        foreach($venues as $venue){
            foreach($venue->Field as $field){
                $field_id->push($field->id);
            }
        }
        $rents = Rent::whereIn('field_id', $field_id)->get();

        $data = collect([]);
        foreach($rents as $rent){
            $start = explode(".",$rent->order('asc'));
            $end = explode(".",$rent->order('desc'));
            $data->push([
                'rent_id' => $rent->id,
                'field' => $rent->Field->name,
                'venue' => $rent->Field->Venue->name,
                'hour_start' => (int) $start[0],
                'minute_start' => (int) $start[1],
                'hour_end' => ((int) $end[0]) + 1,
                'minute_end' => (int) $end[1],
                'date' => $rent->date,
                'status' => $rent->status
            ]);
        }

        return response()->json($data);
    }
}
