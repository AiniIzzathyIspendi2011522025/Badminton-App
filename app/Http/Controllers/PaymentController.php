<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpeningHourDetail;
use App\Models\Rent;
use App\Models\RentDetail;
use App\Models\RentPayment;
use App\Models\History;
use App\Models\PaymentMethodDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\NotifyMail;
use App\Models\Membership;
use App\Models\PointBalance;
use App\Models\PointTransaction;
use App\Models\Promo;

class PaymentController extends Controller
{
    public function detailPayment($id)
    {
        $rent = Rent::find($id);
        $owner_id = $rent->field->venue->user_id;
        $promos = Promo::where('user_id', $owner_id)->get();
        $user = Auth::user();
        // dd($user);
        $membership = Membership::where('user_id', $user->id)->where('venue_id', $rent->field->venue->id)->first();
        // $details = [
        //     'title' => 'Mail from websitepercobaan.com',
        //     'body' => 'This is for testing email using smtp'
        // ];

        // \Mail::to('fahiravelia@gmail.com')->send(new \App\Mail\NotifyMail($details));
        return view('backend.customer.manage_booking.payment', [
            'rent' => $rent,
            'promos' => $promos,
            'membership' => $membership,
            'user' => $user
        ]);
    }

    public function pay(Request $request, $id)
    {
        // dd($request);
        try {
            $rent = Rent::find($id);
            if (Carbon::now() <= Carbon::parse($rent->created_at)->addMinutes(10)) {
                if ($request->status == 2) {
                    $rent->dp = $request->dp;
                }

                $dir = public_path() . '/images/payment';
                $file = $request->file('payment');
                if ($file) {
                    $fileName = Time() . "." . $file->getClientOriginalName();
                    $file->move($dir, $fileName);
                    $rentPayment = new RentPayment;
                    $rentPayment->rent_id = $rent->id;
                    $rentPayment->payment_method_detail_id = $request->payment_method;
                    $rentPayment->payment = $fileName;
                    $rentPayment->save();
                }
                $rent->payment_status = $request->status;
                $rent->kode_promo = $request->kode_promo;
                $rent->diskon = $request->diskon;
                $rent->diskon_membership = $request->diskon_membership;
                $rent->total_price = $request->total_price;
                $rent->save();

                $user = Auth::user();

                $point_transaction = new PointTransaction;
                $point_transaction->user_id = $user->id;
                $point_transaction->rent_id = $rent->id;
                $point_transaction->point_earned = $request->point_earned;
                $point_transaction->point_spent = $request->point_spent;
                $point_transaction->save();

                // Mencari atau membuat instansiasi model PointBalance untuk pengguna yang sedang login
                $point_balance = PointBalance::where('user_id', $user->id)->first();
                if (!$point_balance) {
                    // Jika tidak ada catatan PointBalance untuk pengguna, buat baru
                    $point_balance = new PointBalance();
                    $point_balance->user_id = $user->id;
                    $point_balance->point_balance = 0; // Atur saldo awal jika diperlukan
                }
                $point_balance->point_balance += $request->point_earned;
                $point_balance->point_balance -= $request->point_spent;
                $point_balance->save();



                session()->forget('kode');
                return redirect()->route('customer.booking.index')->with('success', __('toast.create.success.message'));
            } else {
                return redirect()->back('error', 'Batas waktu pembayaran telah berakhir');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back('error', __('toast.create.failed.message'));
        }
    }

    public function booking(Request $request)
    {
        // dd($request);

        if (!$request->has('select_field') || !$request->has('detail_id') || empty($request->select_field) || empty($request->detail_id)) {
            return redirect()->back()->with('error', __('Mohon memilih lapangan dan jadwal sebelum booking'));
        }

        try {
            $rents = Rent::all();
            $details = OpeningHourDetail::whereIn('id', $request->detail_id)->get();
            $rent = new Rent;
            $rent->field_id = $details[0]->field_id;
            $rent->tenant_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $rent->date = $request->date;
            $rent->total_price = $details->sum('price');
            $rent->token = Carbon::now()->format('dmyHis') . '' . (string) ($rents->count() + 1) . '' . $request->select_field . '' . $details[0]->Field->Venue->id;
            if ($request->status == 2) {
            }
            $dir = public_path() . '/images/payment';
            $rent->dp = $request->dp;
            $file = $request->file('payment');
            if ($file) {
                $fileName = Time() . "." . $file->getClientOriginalName();
                $file->move($dir, $fileName);
                $rent->payment = $fileName;
            }

            $rent->save();
            foreach ($details as $detail) {
                $rentDetail = new RentDetail;
                $rentDetail->rent_id = $rent->id;
                $rentDetail->opening_hour_detail_id = $detail->id;
                $rentDetail->save();
            }

            $history = new History;
            $history->user_id = Auth::user()->id;
            $history->rent_id = $rent->id;
            $history->save();

            return redirect()->route('customer.payment.detailPayment', $rent->id)->with('success', __('toast.create.success.message'));
        } catch (\Exception $e) {
            return redirect()->route('customer.dashboard')->with('error', __('toast.create.failed.message'));
        }
    }
}
