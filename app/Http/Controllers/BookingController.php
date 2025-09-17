<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Venue;
use App\Models\User;
use App\Models\Rent;
use App\Models\Day;
use App\Models\Hour;
use App\Models\History;
use App\Models\OpeningHourDetail;
use App\Models\RentDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\BookingList;
use App\Models\OpeningHour;
use Carbon\Carbon;
use DateTime;
use File;
use Storage;
use DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            if (Auth::user()->thisOwner()) {
                $rents = Rent::all();
                $venue = Venue::where('user_id', Auth::user()->id)->where('status', 1)->get()->pluck('name', 'id');
                // $schedules = Schedule::where('')
                $field = Field::pluck('name', 'id');

                return view('backend.owner.manage_booking.index', compact('rents', 'venue', 'field'));
            } elseif (Auth::user()->thisCustomer()) {
                $histories = History::where('user_id', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();

                return view('backend.customer.manage_booking.index', compact('histories'));
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function index_admin()
    {
        //
        try {
            $rents = Rent::all();

            return view('backend.admin.manage_booking.index', compact('rents'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try {
            $venues = Venue::where('user_id', Auth::user()->id)->get();
            $venueId = collect([]);
            foreach ($venues as $venue) {
                $venueId->push($venue->id);
            }

            $field = Field::whereIn('venue_id', $venueId)->get()->pluck('name', 'id');
            $venue = Venue::where('user_id', Auth::user()->id)->where('status', 1)->get()->pluck('name', 'id');
            return view('backend.owner.manage_booking.create', compact('venue', 'field'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->select_field && !$request->detail_id) {
            return redirect()->back()->with('error', __('Gagal Menambahkan Data Booking'));
        }
        try {
            $rents = Rent::all();
            if (Auth::user()->thisCustomer()) {
                $details = OpeningHourDetail::whereIn('id', $request->detail_id)->get();
                $total_price = 0;

                $rent = new Rent;
                $rent->field_id = $request->select_field;
                $rent->tenant_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                $rent->date = $request->date;
                $rent->status = $request->status;
                $rent->total_price = 0;
                $rent->token = Carbon::now()->format('dmyHis') . '' . (string) ($rents->count() + 1) . '' . $request->select_field . '' . $details[0]->Field->Venue->id;
                if ($request->status == 2) {
                    $rent->dp = $request->dp;
                }

                $dir = public_path() . '/images/payment';
                $file = $request->file('payment');
                if ($file) {
                    $fileName = Time() . "." . $file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $rent->payment = $fileName;
                }

                $rent->save();

                foreach ($details as $detail) {
                    $rentDetail = new RentDetail;
                    $rentDetail->rent_id = $rent->id;
                    $rentDetail->hour_id = $detail->OpeningHour->hour_id;
                    $rentDetail->save();
                    $total_price = $total_price + $detail->price;
                }

                $rent->total_price = $total_price;
                $rent->save();
            } elseif (Auth::user()->thisOwner()) {
                $details = OpeningHourDetail::whereIn('id', $request->detail_id)->get();
                $total_price = 0;
                $rent = new Rent;
                $rent->field_id = $request->field;
                $rent->tenant_name = $request->tenant_name;
                $rent->date = $request->date;
                $rent->total_price = 0;
                $rent->status = 2;
                $rent->token = Carbon::now()->format('dmyHis') . '' . (string) ($rents->count() + 1) . '' . $request->select_field . '' . $details[0]->Field->Venue->id;
                if ($request->status == 2) {
                    $rent->dp = $request->dp;
                }
                $rent->save();

                foreach ($details as $detail) {
                    $total_price = $total_price + $detail->price;
                    $rentDetail = new RentDetail;
                    $rentDetail->rent_id = $rent->id;
                    $rentDetail->opening_hour_detail_id = $detail->id;
                    $rentDetail->save();
                }

                $rent->total_price = $total_price;
                $rent->save();
            }

            return redirect()->back()->with('success', __('toast.create.success.message'));
        } catch (\Exception $e) {
            ddd($e);
            return redirect()->back();
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (Auth::user()->thisCustomer()) {
                $rents = Rent::find($id);
                $price = $rents->rentDetail->first()->OpeningHourDetail->price;
                return view('backend.customer.manage_booking.show', compact('rents', 'price'));
            } elseif (Auth::user()->thisOwner()) {
                try {
                    $rents = Rent::find($id);
                    // dd($rents);
                    return view('backend.owner.manage_booking.show', compact('rents'));
                } catch (\Exception $e) {
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.owner.manage_booking.extend');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rents = Rent::all();

            $details = OpeningHourDetail::whereIn('id', $request->detail_id)->get();
            $total_price = 0;
            $rent = Rent::find($id);
            $rent->field_id = $request->field;
            $rent->tenant_name = $request->tenant_name;
            $rent->date = $request->date;
            $rent->total_price = 0;
            $rent->status = 2;
            $rent->token = Carbon::now()->format('dmyHis') . '' . (string) ($rents->count() + 1) . '' . $request->select_field . '' . $details[0]->Field->Venue->id;
            if ($request->status == 2) {
                $rent->dp = $request->dp;
            }
            $rent->save();

            foreach ($rent->RentDetail as $rentDetail) {
                $rentDetail->delete();
            }

            foreach ($details as $detail) {
                $total_price = $total_price + $detail->price;
                $rentDetail = new RentDetail;
                $rentDetail->rent_id = $rent->id;
                $rentDetail->opening_hour_detail_id = $detail->id;
                $rentDetail->save();
            }

            $rent->total_price = $total_price;
            $rent->save();

            return redirect()->back()->with('success', __('toast.create.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $rent = Rent::find($id);
            $rent->delete();
            return redirect()->route('owner.booking.index')->with('success', __('toast.delete.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }

    public function getData(Request $request)
    {
        $data = [];
        if ($request->data == "all") {
            $venues = Venue::where('user_id', $request->owner_id)->get();
            $venue_id = collect([]);
            foreach ($venues as $venue) {
                $venue_id->push($venue->id);
            }
            $fields = Field::whereIn('venue_id', $venue_id)->get();
            $field_id = collect([]);
            foreach ($fields as $field) {
                $field_id->push($field->id);
            }
            $data = Rent::whereIn('field_id', $field_id)->orderBy('id', 'desc')->get();
        } elseif ($request->data == "id") {
            $data = Rent::find($request->id);
        } elseif ($request->data == "select") {
            $id = explode(',', $request->id);
            $data = Rent::wherenotin('id', $id)->get();
        }

        if ($data) return response()->json(BookingList::collection($data));
        return $data;
    }

    public function extend(Request $request)
    {
        $rent = Rent::find($request->id);
        $time = strtotime($rent->date);
        $newformat = date('d M Y', $time);


        $data = [
            'tenant_name' => $rent->tenant_name,
            'venue' => $rent->Field->Venue->name,
            'field' => $rent->Field->name,
            'date' => $newformat
        ];

        return response()->json($data);
    }

    public function apiEdit(Request $request)
    {
        $rent = Rent::find($request->id);


        $data = [
            'tenant_name' => $rent->tenant_name,
            'venue' => $rent->Field->Venue->id,
            'field' => $rent->Field->id,
            'date' => $rent->date
        ];

        return response()->json($data);
    }

    public function confirm($id)
    {
        try {
            $rent = Rent::find($id);
            $rent->status = 2;
            $rent->save();
            if (!$rent->dp) {
                $payment = 'Pembayaran Lunas';
            } else {
                $payment = 'Pembayaran dengan DP';
            }
            $time = strtotime($rent->date);
            $date = date('d M Y', $time);


            $details = [
                'tenant_name' => $rent->tenant_name,
                'token' => $rent->token,
                'created_at' => $rent->created_at->format('d M Y'),
                'date' => $date,
                'payment' => $payment,
                'payment_method' => $rent->RentPayment->PaymentMethodDetail->PaymentMethod->name,
                'rentDetails' => $rent->RentDetail,
                'field' => $rent->Field->name,
                'venue' => $rent->Field->Venue->name,
                'dp' => $rent->dp,
            ];

            return redirect()->route('owner.booking.index')->with('success', __('toast.confirm.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.confirm.failed.message'));
        }
    }

    public function cancel($id)
    {
        try {
            $rent = Rent::find($id);
            $rent->status = 5;
            $rent->reject_note = "Tidak datang pada jam yang ditentukan";
            //data
            $field = $rent->Field;
            $day_id = $rent->rentDetail[0]->OpeningHourDetail->OpeningHour->day_id;
            $price = $rent->rentDetail[0]->OpeningHourDetail->price;

            $first_hour = $rent->rentDetail[0]->OpeningHourDetail->OpeningHour->Hour->hour;
            $date = DateTime::createFromFormat('H.i', $first_hour);
            $date->modify('+20 minutes');
            $new_hour = $date->format('H.i');

            $existingHour = DB::table('hours')->where('hour', $new_hour)->first();

            if (!$existingHour) {
                $hour = new Hour;
                $hour->hour = $new_hour;
                $hour->save();
            } else {
                $hour = $existingHour;
            }

            $existingOpeningHour = DB::table('opening_hours')
                ->where('venue_id', $field->venue_id)
                ->where('day_id', $day_id)
                ->where('hour_id', $hour->id)
                ->first();

            if (!$existingOpeningHour) {
                $opening_hour = new OpeningHour;
                $opening_hour->status = 2;
                $opening_hour->venue_id = $field->venue_id;
                $opening_hour->day_id = $day_id;
                $opening_hour->hour_id = $hour->id;
                $opening_hour->save();
            } else {
                $opening_hour = $existingOpeningHour;
            }

            $existingOpeningHourDetail = OpeningHourDetail::where('field_id', $field->id)
                ->where('opening_hour_id', $opening_hour->id)
                ->first();

            if ($existingOpeningHourDetail) {
                $existingOpeningHourDetail->status = 1;
                $existingOpeningHourDetail->save();
            } else {
                $opening_hour_detail = new OpeningHourDetail;
                $opening_hour_detail->field_id = $field->id;
                $opening_hour_detail->opening_hour_id = $opening_hour->id;
                $opening_hour_detail->price = $price;
                $opening_hour_detail->status = 1;
                $opening_hour_detail->save();
            }



            $rent->delete();
            return redirect()->route('owner.booking.index');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $rent = Rent::find($request->rent_id);
            $rent->status = 3;
            $rent->reject_note = $request->reject_note;
            $rent->save();

            return redirect()->route('owner.booking.index')->with('success', __('toast.reject.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.reject.failed.message'));
        }
    }

    public function finish($id)
    {
        try {
            $rent = Rent::find($id);
            $rent->status = 4;
            $rent->save();
            $first_hour = $rent->rentDetail[0]->OpeningHourDetail->OpeningHour->Hour->hour;
            $opening_hour_detail_id = $rent->rentDetail[0]->OpeningHourDetail->id;
            $date = DateTime::createFromFormat('H.i', $first_hour);
            // dd($opening_hour_detail_id);
            if ($date->format('i') == "20") {
                $opening_hour_detail = OpeningHourDetail::find($opening_hour_detail_id);
                $opening_hour_detail->status = 2;
                $opening_hour_detail->save();
            }
            $time = strtotime($rent->date);
            $date = date('d M Y', $time);

            $details = [
                'tenant_name' => $rent->tenant_name,
                'token' => $rent->token,
                'date' => $date,
                'field' => $rent->Field->name,
                'venue' => $rent->Field->Venue->name,
                'hour' => $rent->order('asc') . ' - ' . $rent->order('desc'),
                'total_price' => $rent->total_price,

            ];

            return redirect()->route('owner.booking.index')->with('success', 'Penyewaan telah berakhir');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.reject.failed.message'));
        }
    }
}
