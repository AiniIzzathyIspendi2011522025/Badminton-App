<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\RentDetail;
use App\Models\OpeningHourDetail;

class ExtendController extends Controller
{
    //
    public function extendBooking(Request $request, $id)
    {
        $rent = Rent::find($id);

        if (!$request->detail_id) {
            return redirect()->back()->with('error', __('Gagal Menambahkan Data Booking'));
        }

        foreach ($request->detail_id as $detail_id) {
            $rentDetail = new RentDetail;
            $rentDetail->rent_id = $rent->id;
            $rentDetail->opening_hour_detail_id = $detail_id;
            $rentDetail->save();

            $detail = OpeningHourDetail::find($detail_id);
            $rent->total_price = $rent->total_price + $detail->price;
            $rent->save();
        }


        return redirect()->route('owner.booking.show', $rent->id);
    }
}
