<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\OpeningHour;
use App\Models\Booking;
use App\Models\Chat;
use App\Models\Membership;
use App\Models\Rent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DB;

class CommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $venues = Venue::where('status', 1)->paginate(12);
            return view('backend.customer.manage_commerce.index', compact('venues'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function show($id)
    {
        try {
            $venue = Venue::find($id);
            $field = Field::where('venue_id', $venue->id)->get();
            // $field_id = collect([]);
            // foreach($field as $row){
            //     $field_id->push($row->id);
            // }
            // foreach($venue->OpeningHour as $open){
            //     if($open->status == 2){
            //         dd($open->checkAvailable());
            //     }
            // }
            // $rents = Rent::where(DB::raw('date_format(date, "%Y-%m-%d")'), Carbon::now()->format('Y-m-d'))->whereIn('field_id', $field_id)->get();
            // dd($rents);
            $membership = null;
            $user = Auth::user();
            if ($user) {
                $membership = Membership::where('user_id', $user->id)->where('venue_id', $venue->id)->first();
            }
            $select_field = Field::where('venue_id', $venue->id)->pluck('name', 'id');
            $field_type = FieldType::select('name', 'id')->get();
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $venue->id)->groupby('day_id')->get();

            return view('backend.customer.manage_commerce.show', compact('venue', 'field', 'field_type', 'id', 'select_field', 'openingHours', 'membership'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function sortByName(Request $request)
    {
        try {
            dd($request);
            if ($request->data == 1) {
                $venues = Venue::where('status', 1)->orderBy('name', 'asc')->get();
                dd($venues);
            } else if ($request->data == 2) {
                $venues = Venue::where('status', 1)->orderBy('name', 'desc')->get();
            }
            return view('backend.customer.manage_commerce.index', compact('venues'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }
}
