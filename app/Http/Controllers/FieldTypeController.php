<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FieldType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FieldTypeList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FieldTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $field_types = FieldType::all();
        toastr()->warning('Warning Message');
        return view('backend.admin.manage_type.index', compact('field_types'));
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
            return view('backend.admin.manage_type.create');
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

            $field_types = new FieldType;
            $field_types->name = $request->name;
            $field_types->save();

            return redirect()->route('admin.field-type.index')->with('success', __('toast.create.success.message'));

        } catch (\Exception $e) {
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
            $field_types = FieldType::find($id);
            return view('backend.admin.manage_type.edit', compact('field_types'));
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
            $field_types = FieldType::find($id);
            $field_types->name = $request->name;
            $field_types->save();
            return redirect()->route('admin.field-type.index')->with('success', __('toast.update.success.message'));
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
        try {
            $field_types = FieldType::find($id);
            $field_types->delete();
            return redirect()->back()->with('success', __('toast.delete.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }

    public function getData(Request $request)
    {
        $data = [];
        if($request->data=="all"){
            $data = FieldType::orderby('id','desc')->get();
        }
        elseif($request->data=="id"){
            $data = FieldType::find($request->id);
        }
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = FieldType::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(FieldTypeList::collection($data));
        return $data;
    }
}
