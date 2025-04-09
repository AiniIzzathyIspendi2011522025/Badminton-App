<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    public function index($id)
    {
        try {
            $venue = Venue::find($id);
            return view('backend.membership.index', compact('venue'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function pay(Request $request, $id)
    {
        try {
            $dir = public_path() . '/images/payment';
            $file = $request->file('payment');
            $fileName = Time() . "." . $file->getClientOriginalName();
            $user_id = Auth::user()->id;
            $today = Carbon::now();
            if ($file) {
                $file->move($dir, $fileName);
            }

            $membership = Membership::where('user_id', $user_id)->where('venue_id', $id)->first();
            if ($membership) {
                $membership->start_date = $today->toDateString();
                $membership->end_date = $today->addMonth()->toDateString();
                $membership->membership_status = 2;
                $membership->payment = $fileName;
                $membership->save();
            } else {
                Membership::create([
                    'user_id' => $user_id,
                    'venue_id' => $id,
                    'start_date' => $today->toDateString(),
                    'end_date' => $today->addMonth()->toDateString(),
                    'payment' => $fileName,
                    'membership_status' => 2
                ]);
            }

            return redirect('/customer/profil');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function owner()
    {
        try {
            $userId = auth()->user()->id;

            // Mengambil semua venue yang dimiliki oleh pengguna yang sedang login
            $venues = Venue::where('user_id', $userId)->get();

            // Inisialisasi array untuk menyimpan memberships
            $memberships = [];

            // Iterasi setiap venue untuk mendapatkan memberships yang terkait
            foreach ($venues as $venue) {
                // Mengambil memberships berdasarkan venue_id dan user_id
                $venueMemberships = Membership::join('venues', 'memberships.venue_id', '=', 'venues.id')
                    ->join('users', 'memberships.user_id', '=', 'users.id') // Join dengan tabel users
                    ->select(
                        'venues.name as nama_venue',
                        DB::raw("CONCAT(users.first_name, ' ', users.last_name) as nama_member"),
                        'memberships.start_date',
                        'memberships.end_date',
                        'memberships.membership_status',
                        'memberships.id as membership_id'
                    )
                    ->where('venues.id', $venue->id)
                    ->where('venues.user_id', $userId)
                    ->get();

                // Menambahkan memberships ke dalam array memberships
                $memberships = array_merge($memberships, $venueMemberships->toArray());
            }

            // Menggunakan dd() untuk menampilkan hasil
            // dd($memberships);
            return view('backend.owner.manage_membership.index', compact('memberships'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        $membership = Membership::find($id);

        return view('backend.owner.manage_membership.show', compact('membership'));
    }

    public function confirm($id)
    {
        $today = Carbon::now();
        $membership = Membership::find($id);
        $membership->membership_status = 1;
        $membership->start_date = $today->toDateString();
        $membership->end_date = $today->addMonth()->toDateString();
        $membership->count_month += 1;
        $membership->save();

        return redirect()->route('owner.membership.owner')->with('success', __('toast.confirmMember.success.message'));
    }

    public function reject($id)
    {
        $membership = Membership::find($id);
        $membership->delete();

        return redirect()->route('owner.membership.owner')->with('success', __('toast.rejectMember.success.message'));
    }
}
