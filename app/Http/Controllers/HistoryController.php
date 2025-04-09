<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Rent;
use App\Models\Venue;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            if(Auth::user()->thisCustomer())
            {
                $histories = History::where('user_id', Auth::user()->id)
                                        ->orderBy('id','desc')
                                        ->get();

                return view('backend.customer.manage_history.index', compact('histories'));
            }
            elseif(Auth::user()->thisOwner())
            {
                $rents = Rent::where('status',4)->get();
                $venue = Venue::where('user_id', Auth::user()->id)->where('status',1)->get()->pluck('name', 'id');
                // $schedules = Schedule::where('')
                $field = Field::pluck('name', 'id');


                return view('backend.owner.manage_history.index', compact('rents','venue','field'));
            }
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
    public function create()
    {
        return view('backend.customer.manage_booking.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        try{
            if(Auth::user()->thisCustomer())
            {
                //
                $histories = History::find($id);

                return view('backend.customer.manage_history.show', compact('histories'));
            }
            elseif(Auth::user()->thisOwner())
            {
                $rents = Rent::find($id);
                return view('backend.owner.manage_history.show', compact('rents'));
            }
        }
        catch(\Exception $e){
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getData(Request $request)
    {
        $data = [];
        if($request->data=="all"){
            $venues = Venue::where('owner_id', $request->owner_id)->get();
            $venue_id = collect([]);
            foreach($venues as $venue){
                $venue_id->push($venue->id);
            }
            $fields = Field::whereIn('venue_id', $venue_id)->get();
            $field_id = collect([]);
            foreach($fields as $field){
                $field_id->push($field->id);
            }
            $data = Rent::whereIn('field_id', $field_id)
                            ->where('id', 4)
                            ->orderBy('id','desc')
                            ->get();
        }

        elseif($request->data=="id"){
            $data = History::find($request->id);
        }

        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = History::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(BookingList::collection($data));
        return $data;
    }
}
