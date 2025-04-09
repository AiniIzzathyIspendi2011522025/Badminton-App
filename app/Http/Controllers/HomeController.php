<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Gate::allows('thisAdmin')) {
            $owners = User::all()->where('role', 'owner')->count();
            $venues = Venue::all()->count();
            $isConfirmed = Venue::where('status', 0)->count();
            $customer = User::all()->where('role', 'customer')->count();
            return view ('backend.admin.dashboard',
            [
                'owners' => $owners,
                'venues' => $venues,
                'isConfirmed' => $isConfirmed,
                'customer' => $customer
            ]
        );
        }elseif (Gate::allows('thisOwner')) {
            Log::info("User ".Auth::user()->first_name." ".Auth::user()->last_name." Berhasil melakukan login ke aplikasi");
            return view ('backend.owner.dashboard');
        }elseif (Gate::allows('thisCustomer')) {
            Log::info("User ".Auth::user()->first_name." ".Auth::user()->last_name." Berhasil melakukan login ke aplikasi");
            return redirect()->route('landing.index');
        }
    }
}
