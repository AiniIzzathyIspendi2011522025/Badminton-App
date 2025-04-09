<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AdminList;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
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
        $admins = User::all()->where('role', 'admin');
        return view('backend.admin.manage_admin.index', compact('admins'));
        } catch (\Exception $e) {
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
        //
        try{
            return view('backend.admin.manage_admin.create');

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
            $user->role = "admin";
            $user->save();

            return redirect()->route('admin.admin.index')->with('success', __('toast.create.success.message'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back('error', __('toast.create.failed.message'));
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
            $admin = User::find($id);
            return view('backend.admin.manage_admin.edit', compact('admin'));
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
            $admin = User::find($id);
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->address = $request->address;
            $admin->handphone = $request->handphone;
            $admin->save();
            return redirect()->route('admin.admin.index')->with('success', __('toast.update.success.message'));
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
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->back()->with('success', __('toast.delete.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }


    public function getData(Request $request)
    {
        $data = [];
        if($request->data=="all"){
            $data = User::all()->where('role', 'admin')->orderby('id','desc')->get();
        }

        elseif($request->data=="id"){
            $data = User::find($request->id);
        }
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = User::wherenotin('id', $id)->get();
        }


        if($data)return response()->json(AdminList::collection($data));
        return $data;
    }
}
