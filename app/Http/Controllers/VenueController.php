<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\User;
use App\Models\Facility;
use App\Models\FacilityDetail;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodDetail;
use App\Models\OpeningHour;
use App\Models\Day;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\Hour;
use App\Models\VenueImage;
use App\Models\OtherFacility;
use App\Http\Resources\VenueList;
use App\Http\Resources\FieldList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use File;
use Storage;
use DB;

class VenueController extends Controller
{
    public function index()
    {
        try {
            $venues = Venue::where('user_id', Auth::user()->id)
                ->orderby('id', 'desc')
                ->get();
            Log::info("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengakses halaman venue");
            return view('backend.owner.manage_venue.index', compact('venues'));
        } catch (\Exception $e) {
            dd($e);
            Log::error("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Gagal mengakses halaman venue");
            return redirect()->back();
        }
    }

    public function index_admin()
    {
        try {
            return view('backend.admin.manage_venue.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toats.index.failed.message'));
        }
    }

    public function index1_admin()
    {
        try {
            return view('backend.admin.manage_venue.index1');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toats.index.failed.message'));
        }
    }

    public function index2_admin()
    {
        try {
            return view('backend.admin.manage_venue.index2');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toats.index.failed.message'));
        }
    }

    public function show_index($id)
    {
        try {
            $venues = Venue::find($id);
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $venues->id)->groupby('day_id')->get();
            return view('backend.admin.manage_venue.show', compact('venues', 'id', 'openingHours'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toats.index.failed.message'));
        }
    }

    public function show1_index($id)
    {
        try {
            $venues = Venue::find($id);
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $venues->id)->groupby('day_id')->get();
            return view('backend.admin.manage_venue.show1', compact('venues', 'id', 'openingHours'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toats.index.failed.message'));
        }
    }

    public function show2_index($id)
    {
        try {
            $venues = Venue::find($id);
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $venues->id)->groupby('day_id')->get();
            return view('backend.admin.manage_venue.show2', compact('venues', 'id', 'openingHours'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toats.index.failed.message'));
        }
    }

    public function create()
    {
        //
        $facilities = Facility::all();
        $payment_methods = PaymentMethod::all();
        $days = Day::all();
        $hours = Hour::all();
        try {
            return view('backend.owner.manage_venue.create', compact('facilities', 'payment_methods', 'days', 'hours'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            $venue = new Venue;
            $venue->name = $request->name;
            if ($request->membership_discount !== "" && $request->membership_price !== "") {
                $venue->isMembership = true;
                $venue->membership_discount = $request->membership_discount;
                $venue->membership_price = $request->membership_price;
            }
            $venue->address = $request->address;
            $venue->information = $request->information;
            $venue->phone_number = $request->phone_number;
            $venue->latitude = $request->latitude;
            $venue->longitude = $request->longitude;
            $venue->dp_percentage = $request->dp_percentage;
            $venue->user_id = Auth::user()->id;

            $dir = public_path() . '/images/imb';
            $files = $request->file('imb');

            if ($files) {
                $fileName = Time() . "." . $files->getClientOriginalName();
                $files->move($dir, $fileName);
                $venue->imb = $fileName;
            }
            $venue->save();

            //Payment method
            if ($request->payment_methods) {
                for ($i = 0; $i < count($request->payment_methods); $i++) {
                    $paymentMethodDetail = new PaymentMethodDetail;
                    $paymentMethodDetail->venue_id = $venue->id;
                    $paymentMethodDetail->payment_method_id = $request->payment_methods[$i];
                    $paymentMethodDetail->no_rek = $request->no_rek[$i];
                    $paymentMethodDetail->save();
                }
            }
            $facilities = Facility::all();
            foreach ($facilities as $facility) {
                $facility_detail = new FacilityDetail;
                $facility_detail->venue_id = $venue->id;
                $facility_detail->facility_id = $facility->id;
                $facility_detail->save();
            }
            foreach ($request->facility as $facility) {
                $facility_detail = FacilityDetail::where('venue_id', $venue->id)
                    ->where('facility_id', $facility)
                    ->first();
                $facility_detail->status = 2;
                $facility_detail->save();
            }
            //Other Facility
            for ($i = 0; $i < count($request->other_facility); $i++) {
                if ($request->other_facility[$i] != NULL) {
                    $otherFacility = new OtherFacility;
                    $otherFacility->name = $request->other_facility[$i];
                    $otherFacility->venue_id = $venue->id;
                    $otherFacility->save();
                }
            }
            $hours = Hour::all();
            foreach ($request->day as $day) {
                foreach ($hours as $hour) {
                    $opening_hour = new OpeningHour;
                    $opening_hour->venue_id = $venue->id;
                    $opening_hour->day_id = $day;
                    $opening_hour->hour_id = $hour->id;
                    $opening_hour->save();
                }
            }
            foreach ($request->day as $day) {
                if (isset($request->hour[$day])) {
                    foreach ($request->hour[$day] as $hour) {
                        $opening_hour = OpeningHour::where('venue_id', $venue->id)
                            ->where('day_id', $day)
                            ->where('hour_id', $hour)
                            ->first();
                        $opening_hour->status = 2;
                        $opening_hour->save();
                    }
                }
            }

            $dir = public_path() . '/images/venue';
            $files = $request->file('image_venue');
            if ($files) {
                foreach ($files as $file) {
                    $fileName = Time() . "." . $file->getClientOriginalName();
                    $file->move($dir, $fileName);

                    $venue_image = new VenueImage;
                    $venue_image->venue_id = $venue->id;
                    $venue_image->image = $fileName;
                    $venue_image->save();
                }
            }

            return redirect()->route('owner.venue.index')->with('success', __('toast.create.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    public function show($id)
    {
        try {
            $day = Day::pluck('name', 'id');
            $venues = Venue::find($id);
            $field_type = FieldType::select('name', 'id')->get();
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $venues->id)->groupby('day_id')->get();

            Log::info("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengakses halaman detail venue pada venue");
            return view('backend.owner.manage_venue.show', compact('venues', 'field_type', 'id', 'openingHours', 'day'));
        } catch (\Exception $e) {
            Log::error("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Gagal mengakses halaman detail venue pada venue");
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $venues = Venue::find($id);
            if ($request->data) {
                $data = 'request';
            } else {
                $data = 'none';
            }
            $days = Day::all();
            $hours = Hour::all();
            $facilitie_details = FacilityDetail::where('venue_id', $venues->id)->get();
            $payment_method_details = PaymentMethodDetail::where('venue_id', $venues->id)->get();
            $opening_hours = OpeningHour::where('venue_id', $venues->id)->get();
            $open_days = OpeningHour::select('day_id')->where('venue_id', $venues->id)->groupby('day_id')->get();
            $venue_images = VenueImage::where('venue_id', $venues->id)->get();
            $payment_methods = PaymentMethod::all();
            $other_facilities = OtherFacility::where('venue_id', $venues->id)->get();
            //dd($payment_method_details);

            Log::info("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengakses halaman edit venue pada venue");
            return view(
                'backend.owner.manage_venue.edit',
                compact('venues', 'facilitie_details', 'payment_method_details', 'opening_hours', 'venue_images', 'open_days', 'payment_methods', 'data', 'other_facilities', 'days', 'hours')
            );
        } catch (\Exception $e) {

            Log::error("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Gagal mengakses halaman edit venue pada venue");
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        //
        // dd($request);
        try {
            $venue = Venue::find($id);
            $venue->name = $request->name;

            if ($request->data == 'request') {
                $venue->status = 0;
            }
            if (!$request->membership) {
                $venue->membership_discount = 0;
                $venue->membership_price = 0;
                $venue->isMembership = 0;
            } else {
                $venue->membership_discount = $request->membership_discount;
                $venue->membership_price = $request->membership_price;
                $venue->isMembership = 1;
            }
            $venue->address = $request->address;
            $venue->latitude = $request->latitude;
            $venue->longitude = $request->longitude;
            $venue->information = $request->information;
            $venue->phone_number = $request->phone_number;
            $venue->dp_percentage = $request->dp_percentage;
            if ($request->file('imb')) {
                //Rule upload
                if ($venue->imb) {
                    if (File::exists(public_path('images/imb/' . $venue->imb))) {
                        File::delete(public_path('images/imb/' . $venue->imb));
                    }

                    $dir = public_path() . '/app/public/images/imb';
                    $fileImbUpload = $request->file('imb');

                    $fileName = Time() . "." . $fileImbUpload->getClientOriginalName();
                    $fileImbUpload->move($dir, $fileName);

                    if ($fileImbUpload) {
                        $venue->imb = $fileName;
                    }
                } else {
                    $dir = public_path() . '/app/public/images/imb';
                    $fileImbUpload = $request->file('imb');

                    $fileName = Time() . "." . $fileImbUpload->getClientOriginalName();
                    $fileImbUpload->move($dir, $fileName);

                    if ($fileImbUpload) {
                        $venue->imb = $fileName;
                    }
                }
            }
            $venue->save();
            //Payment method
            $paymentMethodDetails = PaymentMethodDetail::where('venue_id', $venue->id)->get();
            foreach ($paymentMethodDetails as $paymentMethodDetail) {
                $paymentMethodDetail->delete();
            }

            if ($request->payment_methods) {
                for ($i = 0; $i < count($request->payment_methods); $i++) {
                    $paymentMethodDetail = new PaymentMethodDetail;
                    $paymentMethodDetail->venue_id = $venue->id;
                    $paymentMethodDetail->payment_method_id = $request->payment_methods[$i];
                    $paymentMethodDetail->no_rek = $request->no_rek[$i];
                    $paymentMethodDetail->save();
                }
            }

            $facility_details1 = FacilityDetail::where('venue_id', $venue->id)
                ->whereIn('id', $request->facility)->get();

            foreach ($facility_details1 as $facility_detail) {
                $facility_detail->status = 2;
                $facility_detail->save();
            }

            $facility_details2 = FacilityDetail::where('venue_id', $venue->id)
                ->whereNotIn('id', $request->facility)->get();

            foreach ($facility_details2 as $facility_detail) {
                $facility_detail->status = 1;
                $facility_detail->save();
            }
            $opening_hours2 = OpeningHour::where('venue_id', $venue->id)
                ->where('status', 2)->get();

            foreach ($opening_hours2 as $opening_hour) {
                $opening_hour->status = 1;
                $opening_hour->save();
            }


            foreach ($request->day as $day) {
                if (isset($request->hour[$day])) {
                    foreach ($request->hour[$day] as $hour) {
                        $opening_hour = OpeningHour::where('venue_id', $venue->id)
                            ->where('day_id', $day)
                            ->where('hour_id', $hour)
                            ->first();

                        if ($opening_hour !== null) {
                            $opening_hour->status = 2;
                            $opening_hour->save();
                            // dd($opening_hour);
                        }
                    }
                }
            }

            $dir = public_path() . '/images/venue';
            $files = $request->file('image_venue');

            if ($files) {
                foreach ($files as $file) {
                    $fileName = Time() . "." . $file->getClientOriginalName();
                    $file->move($dir, $fileName);

                    $venue_image = new VenueImage;
                    $venue_image->venue_id = $venue->id;
                    $venue_image->image = $fileName;
                    $venue_image->save();
                }
            }
            Log::notice("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengedit data venue pada venue");
            if ($request->data == 'request') {
                return redirect()->route('owner.venue.index')->with('success', __('toast.update.success.message'));
            }
            return redirect()->route('owner.venue.show', $venue->id)->with('success', __('toast.update.success.message'));
        } catch (\Exception $e) {
            Log::error("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Gagal mengedit data venue pada venue");
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    public function destroy($id)
    {
        try {
            $venues = Venue::find($id);
            $venues->delete();
            return redirect()->route('owner.venue.index')->with('success', __('toast.delete.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }

    public function getLocation(Request $request)
    {
        $data = [];
        $data = Venue::select(['latitude', 'longitude'])
            ->where('id', $request->id)
            ->get();

        return response()->json($data);
    }

    public function getData(Request $request)
    {
        $data = [];
        if ($request->data == "all") {
            $data = Venue::where('status', $request->status)
                ->orderby('id', 'desc')
                ->get();
        } elseif ($request->data == "id") {
            $data = Venue::find($request->id);
        } elseif ($request->data == "select") {
            $id = explode(',', $request->id);
            $data = Venue::wherenotin('id', $id)->get();
        }

        if ($data) return response()->json(VenueList::collection($data));
        return $data;
    }

    public function getImage(Request $request)
    {
        $data = [];
        $data = VenueImage::select('image')
            ->where('venue_id', $request->venue_id)
            ->get();
        return response()->json($data);
    }

    public function confirm($id)
    {
        try {
            $venue = Venue::find($id);
            $venue->status = 1;
            $venue->save();

            return redirect()->route('admin.venue.index.admin')->with('success', __('toast.confirm.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.confirm.failed.message'));
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $venue = Venue::find($request->venue_id);
            $venue->status = 2;
            $venue->reject_note = $request->reject_note;
            $venue->save();

            return redirect()->route('admin.venue.index.admin')->with('success', __('toast.reject.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.reject.failed.message'));
        }
    }

    public function destroyImage($id)
    {
        try {
            $file = VenueImage::find($id);
            if (File::exists('images/venue/' . $file->image)) {
                File::delete('images/venue/' . $file->image);
            }
            $file->delete();

            return json_encode(array('statusCode' => 200));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }
}
