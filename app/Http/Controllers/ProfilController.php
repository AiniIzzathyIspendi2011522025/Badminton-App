<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Owner;
use App\Models\PointBalance;
use App\Models\PointTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            if (Auth::user()->thisCustomer()) {
                $customers = User::where('id', Auth::user()->id)->get();
                $memberships = Membership::where('user_id', $customers[0]->id)->get();
                $points = PointBalance::with('venue')->where('user_id', $customers[0]->id)->get();
                $point_transactions = PointTransaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
                Log::info("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengakses halaman index profil");
                return view('backend.customer.manage_profil.index', compact('customers', 'memberships', 'points', 'point_transactions'));
            } elseif (Auth::user()->thisOwner()) {
                $owners = User::where('id', Auth::user()->id)->get();

                Log::info("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengakses halaman index profil");
                return view('backend.owner.manage_profil.index', compact('owners'));
            }
        } catch (\Exception $e) {
            dd($e);
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
        try {
            if (Auth::user()->thisCustomer()) {
                $customer = User::find($id);

                Log::info("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengakses halaman edit profil");
                return view('backend.customer.manage_profil.edit', compact('customer'));
            } else if (Auth::user()->thisOwner()) {
                $owner = User::find($id);

                Log::info("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengakses halaman edit profil");
                return view('backend.owner.manage_profil.edit', compact('owner'));
            }
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
        try {
            if (Auth::user()->thisCustomer()) {
                $customer = User::find($id);
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->handphone = $request->handphone;
                $customer->address = $request->address;
                $customer->avatar = $request->avatar;

                $dir = public_path() . '/images/customer';
                $file = $request->file('avatar');

                if ($file) {
                    $fileName = Time() . "." . $file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $customer->avatar = $fileName;
                }

                $customer->save();

                Log::notice("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengedit data profil");

                return redirect()->route('customer.profil.index')->with('success', __('toast.update.success.message'));
            } elseif (Auth::user()->thisOwner()) {
                $owner = User::find($id);
                $owner->first_name = $request->first_name;
                $owner->last_name = $request->last_name;
                $owner->handphone = $request->handphone;
                $owner->address = $request->address;
                $owner->avatar = $request->avatar;
                $owner->ktp = $request->ktp;
                $dir = public_path() . '/images/owner';
                $file = $request->file('avatar');

                if ($file) {
                    $fileName = Time() . "." . $file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $owner->avatar = $fileName;
                }

                $dir = public_path() . '/images/ktp';
                $file = $request->file('ktp');

                if ($file) {
                    $fileName = Time() . "." . $file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $owner->ktp = $fileName;
                }
                $owner->save();

                Log::notice("User " . Auth::user()->first_name . " " . Auth::user()->last_name . " Berhasil mengedit data profil");

                return redirect()->route('owner.profil.index')->with('success', __('toast.update.success.message'));
            }
        } catch (\Exception $e) {
            dd($e);
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
    }
}
