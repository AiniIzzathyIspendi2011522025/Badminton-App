<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Day;
use App\Models\Venue;
use App\Models\Rent;
use App\Models\Hour;
use App\Models\OpeningHourDetail;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use DB;

class SelectController extends Controller
{
    public function getDataField($id)
    {
        $data = Field::select('id', 'name')
            ->where('venue_id', $id)
            ->get();

        return response()->json($data);
    }
    public function getDataSchedule(Request $request)
    {
        $datas = [];
        $available = new Collection;
        $hours = Hour::all();
        foreach ($hours as $hour) {
            $available[$hour->id] = 1;
        }
        $date = strtotime($request->date);
        $day = date('l', $date);
        $day_id = Day::where('slug', $day)->first();
        $rents = Rent::where(DB::raw('date_format(date, "%Y-%m-%d")'), date('Y-m-d', $date))->where('field_id', $request->field_id)->get();
        foreach ($rents as $rent) {
            foreach ($rent->rentDetail as $rentDetail) {
                $available[$rentDetail->OpeningHourDetail->OpeningHour->hour_id] = 2;
            }
        }
        $datas = DB::table('opening_hours')
            ->select(
                'opening_hour_details.id as detail_id',
                'opening_hour_details.price',
                'hours.hour',
                'opening_hours.hour_id'
            )
            ->join('opening_hour_details', 'opening_hours.id', '=', 'opening_hour_details.opening_hour_id')
            ->join('hours', 'hours.id', '=', 'opening_hours.hour_id')
            ->where('opening_hour_details.field_id', $request->field_id)
            ->where('opening_hours.venue_id', $request->venue_id)
            ->where('opening_hours.day_id', $day_id->id)
            ->where('opening_hour_details.status', 1) // Menambahkan kondisi untuk status = 1
            ->orderBy('hours.hour', 'asc') // Menambahkan pengurutan berdasarkan 'hours.hour' secara ascending
            ->get();

        foreach ($datas as $data) {
            $hour = date('Y-m-d', $date) . " " . "$data->hour" . ".00";
            $hour = Carbon::parse($hour);
            $time = strtotime($hour);

            $now = Carbon::now();
            $now = strtotime($now);

            if ($available[$data->hour_id] == 2) {
                $data->available = 2;
            } else {
                if ($time < $now) {
                    $data->available = 3;
                    $data->date = date('Y-m-d', $date);
                    $data->now = $now;
                    $data->coba = $hour;
                    $data->time = $time;
                } else {
                    $data->available = 1;
                }
            }
        }
        return response()->json($datas);
    }
    public function editDataSchedule(Request $request)
    {
        $datas = [];
        $available = new Collection;
        $hours = Hour::all();
        foreach ($hours as $hour) {
            $available[$hour->id] = 1;
        }
        $date = strtotime($request->date);
        $day = date('l', $date);
        $day_id = Day::where('slug', $day)->first();
        $rents = Rent::where(DB::raw('date_format(date, "%Y-%m-%d")'), date('Y-m-d', $date))->where('field_id', $request->field_id)->get();
        foreach ($rents as $rent) {
            foreach ($rent->rentDetail as $rentDetail) {
                $available[$rentDetail->OpeningHourDetail->OpeningHour->hour_id] = 2;
            }
        }
        $rent = Rent::find($request->rent_id);
        foreach ($rent->RentDetail as $rentDetail) {
            $available[$rentDetail->OpeningHourDetail->OpeningHour->hour_id] = 4;
        }

        $datas = DB::table('opening_hours')
            ->select('opening_hour_details.id as detail_id', 'opening_hour_details.price', 'hours.hour', 'opening_hours.hour_id')
            ->join('opening_hour_details', 'opening_hours.id', '=', 'opening_hour_details.opening_hour_id')
            ->join('hours', 'hours.id', '=', 'opening_hours.hour_id')
            ->where('opening_hour_details.field_id', $request->field_id)
            ->where('opening_hours.venue_id', $request->venue_id)
            ->where('opening_hours.day_id', $day_id->id)
            ->get();

        foreach ($datas as $data) {
            $hour = date('Y-m-d', $date) . " " . "$data->hour" . ".00";
            $hour = Carbon::parse($hour);
            $time = strtotime($hour);

            $now = Carbon::now();
            $now = strtotime($now);

            if ($available[$data->hour_id] == 2) {
                $data->available = 2;
            } elseif ($available[$data->hour_id] == 4) {
                $data->available = 4;
            } else {
                if ($time < $now) {
                    $data->available = 3;
                    $data->date = date('Y-m-d', $date);
                    $data->now = $now;
                    $data->coba = $hour;
                    $data->time = $time;
                } else {
                    $data->available = 1;
                }
            }
        }


        return response()->json($datas);
    }
}
