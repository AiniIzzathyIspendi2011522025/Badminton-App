<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Promo;
use App\Models\Venue;
use DB;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        try {
            $venues = Venue::where('status', 1)->get();
            $promo = Promo::all();
            return view('backend.landing.landing', compact('venues', 'promo'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }
    //
    public function find(Request $request)
    {
        try {
            $venues = Venue::where('status', 1)->where('name', 'like', '%' . $request->find . '%')->orderBy('name', 'asc')->paginate(12);
            return view('backend.customer.manage_commerce.index', compact('venues'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function sortType($id)
    {
        try {
            $fields = Field::where('field_type_id', $id)->get();
            $venue_id = collect([]);;
            foreach ($fields as $field) {
                $venue_id->push($field->venue_id);
            }

            $venues = Venue::whereIn('id', $venue_id)->paginate(12);
            return view('backend.customer.manage_commerce.index', compact('fields', 'venues'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function sortByName(Request $request)
    {
        try {
            if ($request->data == 1) {
                $venues = Venue::where('status', 1)->orderBy('name', 'asc')->paginate(12);
            } else if ($request->data == 2) {
                $venues = Venue::where('status', 1)->orderBy('name', 'desc')->paginate(12);
            }
            return view('backend.customer.manage_commerce.index', compact('venues'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function sortByType(Request $request)
    {
        try {
            $fields = Field::where('field_type_id', $request->type)->get();
            $venue_id = collect([]);;
            foreach ($fields as $field) {
                $venue_id->push($field->venue_id);
            }

            $venues = Venue::whereIn('id', $venue_id)->paginate(12);

            return view('backend.customer.manage_commerce.index', compact('venues'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function sortByAround(Request $request)
    {
        try {
            $venues = Venue::select("venues.*", \DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
            * cos(radians(venues.latitude))
            * cos(radians(venues.longitude) - radians(" . $request->longitude . "))
            + sin(radians(" . $request->latitude . "))
            * sin(radians(venues.latitude))) AS distance"))
                ->having('distance', '<', 5)
                ->orderby('distance', 'asc')
                ->paginate(12);
            return view('backend.customer.manage_commerce.index', compact('venues'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }
}
