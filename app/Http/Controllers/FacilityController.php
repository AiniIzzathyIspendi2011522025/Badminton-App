<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FacilityList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $facilities = Facility::all();
        toastr()->warning('Warning Message');
        return view('backend.admin.manage_facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try{
            return view('backend.admin.manage_facility.create');
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
        //
        try{
            $request->validate([
                'name' => 'required|string|max:40'
            ]);

            $facilities = new Facility;
            $facilities->name = $request->name;
            $facilities->icon = $request->icon;
            $facilities->save();

            return redirect()->route('admin.facility.index')->with('success', __('toast.create.success.message'));

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.create.failed.message'));
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
        //
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
        try{
            $facilities = Facility::find($id);
            dd($facilities);
            return view('backend.admin.manage_facility.edit', compact('facilities'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
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
        try{
            $facilities = Facility::find($id);
            $facilities->name = $request->name;
            $facilities->icon = $request->icon;
            $facilities->save();
            return redirect()->route('admin.facility.index')->with('success', __('toast.update.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
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
        //
        try{
            $facilities = Facility::find($id);
            $facilities->delete();
            return redirect()->back()->with('success', __('toast.delete.success.message'));

        } catch (\Exception $e) {
            return redirect()->back()->with('success', __('toast.delete.failed.message'));
        }
    }

    public function getData(Request $request)
    {
        $data = [];
        if($request->data=="all"){
            $data = Facility::orderby('id','desc')->get();
        }
        elseif($request->data=="id"){
            $data = Facility::find($request->id);
        }
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = Facility::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(FacilityList::collection($data));
        return $data;
    }
}
