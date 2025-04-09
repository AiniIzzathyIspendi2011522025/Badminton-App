<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Field;
use App\Models\Rent;
use DB;
use PDF;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $venues = Venue::where('user_id', Auth::user()->id)
            ->orderby('id','desc')
            ->get();
            return view('backend.owner.manage_report.index', compact('venues'));
        }
        catch(\Exception $e){

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        try{
            $venues = Venue::whereIn('id', $request->venue)->get();
            $venue_select = Venue::whereIn('id', $request->venue)->pluck('name', 'id');
            $date = explode(" - ",$request->date_range);
            $data = [
                'venues' => $venues,
                'date' => $date
            ];
            $venue_id = $request->venue;
            $date_range = $request->date_range;

            return view('backend.owner.manage_report.view_print', compact('venues', 'date', 'venue_id', 'date_range', 'venue_select'));

            // $pdf = PDF::loadView('backend.owner.manage_report.print', $data);

            // return $pdf->download('itsolutionstuff.pdf');
        }
        catch(\Exception $e){
            return redirect()->back();
        }

    }

    public function print(Request $request)
    {
        try{
            $venues = Venue::whereIn('id', $request->venue)->get();
            $date = explode(" - ",$request->date_range);
            $data = [
                'venues' => $venues,
                'date' => $date
            ];

            $pdf = PDF::loadView('backend.owner.manage_report.print', $data);

            return $pdf->download('Laporan Transaksi'. $date[0]. '-' . $date[1] .'.pdf');
        }
        catch(\Exception $e) {
            return redirect()->back();
        }
    }
}
