<?php namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;

class MapController extends Controller
{
    public function getVenueAround(Request $request){
        $venues = Venue::whereIn('id', $request->venue_id)->get();

        return response()->json($venues);
    }
}
