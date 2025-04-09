<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venue;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\Day;
use App\Models\Hour;
use App\Models\OpeningHour;
use App\Models\OpeningHourDetail;
use App\Http\Resources\FieldList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use File;
use Storage;
use DB;


class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function fieldCreate($id)
    {
        try{
            $venue = Venue::find($id);
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $venue->id)->groupby('day_id')->get();

            $day_id = collect([]);
            foreach($openingHours as $openingHour){
                $day_id->push($openingHour->day_id);
            }
            $day = Day::whereIn('id', $day_id)->pluck('name','id');
            $field_type = FieldType::select('name','id')->get();

            Log::info("User ".Auth::user()->first_name." ".Auth::user()->last_name." Berhasil mengakses halaman tambah lapangan");

            return view('backend.owner.manage_field.create', compact('venue','field_type', 'day'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function fieldStore(Request $request, $id)
    {
        try {

            if(!Field::where('venue_id', $id)->whereRaw("UPPER(name) = '".strtoupper($request->field_name)."'")->first()){
                $field = new Field;
                $field->name = $request->field_name;
                $field->field_type_id = $request->field_type;
                $field->venue_id = $id;

                $dir = public_path().'/images/field';
                $file = $request->file('field_image');

                if($file){
                    $fileName = Time().".".$file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $field->image = $fileName;
                }
                $field->save();

                if($field){
                    $key_day = array_keys($request->detail);

                    for($i = 0; $i < count($key_day); $i++){
                        for($x = 0; $x < count($request->detail[$key_day[$i]]); $x++){
                            for($y = 0; $y < count($request->detail[$key_day[$i]][$x]); $y++){
                                $openingHour = OpeningHour::where('venue_id', $id)
                                ->where('day_id', $key_day[$i])
                                ->where('hour_id', $request->detail[$key_day[$i]][$x][$y])
                                ->first();

                                $detail = new OpeningHourDetail;
                                $detail->field_id = $field->id;
                                $detail->opening_hour_id = $openingHour->id;
                                $detail->price = $request->price[$key_day[$i]][$x];
                                $detail->save();
                            }
                        }
                    }
                }
            }else{
                return redirect()->back()->with('error', __('toast.create.unique.message'));
            }

            Log::notice("User ".Auth::user()->first_name." ".Auth::user()->last_name." Berhasil menambahkan lapangan baru");

            return redirect()->route('owner.venue.show', $id)->with('success', __('toast.create.success.message'));
            //return view('backend.owner.manage_field.asik', compact('venues','fields','field_type','id', 'openingHours','day'));
        } catch (\Exception $e) {
            Log::error("User ".Auth::user()->first_name." ".Auth::user()->last_name." Gagal menambahkan lapangan baru");
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    public function fieldScheduleEdit($id){
        try{
            $fields = Field::find($id);
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $fields->Venue->id)->groupby('day_id')->get();

            $day_id = collect([]);
            foreach($openingHours as $openingHour){
                $day_id->push($openingHour->day_id);
            }
            $day = Day::whereIn('id', $day_id)->pluck('name','id');
            $field_type = FieldType::select('name','id')->get();

            $details = OpeningHourDetail::join('opening_hours', 'opening_hour_details.opening_hour_id', '=', 'opening_hours.id')
                                        ->where('field_id', $fields->id)
                                        ->get()
                                        ->groupby('day_id');

            $selected_id = collect([]);
            foreach($details as $index => $detail){
                $selected_id->push($index);
            }
            //dd($details);
            return view('backend.owner.manage_field.scheduleEdit', compact('fields','field_type','id','day','selected_id'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function fieldScheduleUpdate(Request $request, $id){
        try{
            $fields = Field::find($id);
            $key_day = array_keys($request->detail);
            for($i = 0; $i < count($key_day); $i++){
                for($x = 0; $x < count($request->detail[$key_day[$i]]); $x++){
                    for($y = 0; $y < count($request->detail[$key_day[$i]][$x]); $y++){
                        //dd($request->detail[$key_day[$i]][$x][$y]);
                        $openingHour = OpeningHour::where('venue_id', $fields->Venue->id)
                        ->where('day_id', $key_day[$i])
                        ->where('hour_id', $request->detail[$key_day[$i]][$x][$y])
                        ->first();

                        $detail = OpeningHourDetail::where('field_id', $id)->where('opening_hour_id', $openingHour->id)->first();
                        // dd($openingHour->id, $id);
                        $detail->price = $request->price[$key_day[$i]][$x];

                        $detail->save();
                    }
                }
            }
            return redirect()->route('owner.venue.field-show', $id)->with('success', __('toast.update.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function fieldShow($id)
    {
        try{
            $fields = Field::find($id);
            $field_type = FieldType::select('name','id')->get();
            //$openingHours = OpeningHour::select('day_id')->where('venue_id', $venues->id)->groupby('day_id')->get();

            Log::info("User ".Auth::user()->first_name." ".Auth::user()->last_name." Berhasil mengakses halaman detail lapangan");

            return view('backend.owner.manage_field.show', compact('fields','field_type','id'));
        }
        catch(\Exception $e){

            Log::error("User ".Auth::user()->first_name." ".Auth::user()->last_name." Gagal mengakses halaman detail lapangan");
            return redirect()->back()->with('error', __('toats.index.failed.message'));
        }
    }

    public function edit($id)
    {
        //
        try{
            $fields = Field::find($id);
            $openingHours = OpeningHour::select('day_id')->where('venue_id', $fields->Venue->id)->groupby('day_id')->get();

            $day_id = collect([]);
            foreach($openingHours as $openingHour){
                $day_id->push($openingHour->day_id);
            }
            $day = Day::whereIn('id', $day_id)->pluck('name','id');
            $field_type = FieldType::select('name','id')->get();

            $details = OpeningHourDetail::join('opening_hours', 'opening_hour_details.opening_hour_id', '=', 'opening_hours.id')
                                        ->where('field_id', $fields->id)
                                        ->get()
                                        ->groupby('day_id');

            $selected_id = collect([]);
            foreach($details as $index => $detail){
                $selected_id->push($index);
            }
            //dd($details);
            return view('backend.owner.manage_field.edit', compact('fields','field_type','id','day','selected_id'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {

        // dd($request);
        try{
            $field = Field::find($id);
            if(!Field::where('venue_id', $id)->whereRaw("UPPER(name) = '".strtoupper($request->field_name)."'")->where('id', '!=', $id)->first()){
                $field->name = $request->field_name;
                $field->field_type_id = $request->field_type;
                // $field->venue_id = $id;
                $dir = public_path().'/images/field';
                $file = $request->file('field_image');

                if($file){
                    $fileName = Time().".".$file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $field->image = $fileName;
                }
                $field->save();
            }else{
                return redirect()->back()->with('error', __('toast.create.unique.message'));
            }


            return redirect()->route('owner.venue.show', $field->venue_id)->with('success', __('toast.update.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        //
        try{
            $fields = Field::find($id);
            $fields->delete();

            Log::notice("User ".Auth::user()->first_name." ".Auth::user()->last_name." Berhasil menghapus lapangan");
            return redirect()->back()->with('success', __('toast.delete.success.message'));

        } catch (\Exception $e) {

            Log::error("User ".Auth::user()->first_name." ".Auth::user()->last_name." Gagal menghapus lapangan");
            return redirect()->back()->with('success', __('toast.delete.failed.message'));
        }
    }
    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Field::where('venue_id', $request->id)
            ->orderby('id','desc')
            ->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = Field::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = Field::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(FieldList::collection($data));
        return $data;
    }
}
