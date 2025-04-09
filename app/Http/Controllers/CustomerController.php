<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CustomerList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = User::all()->where('role', 'customer');
        return view('backend.admin.manage_customer.index', compact('customers'));
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
            return view('backend.admin.manage_customer.create');
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
                'first_name' => 'required|string|max:40',
                'last_name' => 'required|string|max:40',
                'email' => 'required|string|max:255|email',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8'
            ]);

            $user = new User;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->handphone = $request->handphone;
            $user->address = $request->address;
            $user->save();

            return redirect()->route('admin.customer.index')->with('success', __('toast.create.success.message'));

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
            $customer = User::find($id);
            return view('backend.admin.manage_customer.edit', compact('customer'));
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
            $customer = User::find($id);
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->handphone = $request->handphone;
            $customer->address = $request->address;
            $customer->save();

            return redirect()->route('admin.customer.index')->with('success', __('toast.update.success.message'));
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
        $customers = User::find($id);
        $customers->delete();
        return redirect()->back()->with('success', __('toast.delete.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }
    public function getData(Request $request)
    {
        $data = [];
        if($request->data=="all"){
            $data = User::orderby('id','desc')->where('role', 'customer')->get();
        }
        elseif($request->data=="id"){
            $data = User::find($request->id);
        }
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = User::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(CustomerList::collection($data));
        return $data;
    }
}


