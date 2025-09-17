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
        $venueId = $rent->field->venue_id; // venue dari transaksi
        $pointBalance = PointBalance::where('user_id', $user->id)
            ->where('venue_id', $venueId)
            ->first();
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
            'user' => $user,
            'pointBalance' => $pointBalance,
        ]);
    }

    public function pay(Request $request, $id){
        try {
            $rent = Rent::with('field')->findOrFail($id);

            // dd($request->all());

            if (Carbon::now() <= Carbon::parse($rent->created_at)->addMinutes(10)) {
                if ($request->status == 2) {
                    $rent->dp = $request->dp;
                }

                $dir = public_path() . '/images/payment';
                $file = $request->file('payment');

                if ($request->total_price > 0 && !$file) {
                    return back()->withErrors(['payment_proof' => 'Bukti pembayaran wajib diunggah jika ada sisa tagihan.']);
                }

                // Tahap 2: Proses - Jika lolos validasi, buat record pembayaran
                if ($request->point_spent > 0 || $request->total_price > 0) {
                    $rentPayment = new RentPayment();
                    $rentPayment->rent_id = $rent->id;
                    $rentPayment->payment_method_detail_id = $request->payment_method;

                    $request->total_price > 0 ? $rentPayment->note = 'B-Poin' : null;

                    if($request->total_price > 0 && $request->point_spent > 0){
                        $rentPayment->note = 'B-Poin';
                    } elseif ($request->point_spent > 0) {
                        $rentPayment->note = 'B-Poin';
                    }

                    // Jika ada file yang diunggah, proses filenya.
                    if ($file) {
                        $fileName = time() . "." . $file->getClientOriginalName();
                        $file->move($dir, $fileName);
                        $rentPayment->payment = $fileName;
                    }

                    $rentPayment->save();
                }


                $rent->payment_status = $request->status;
                $rent->kode_promo = $request->kode_promo;
                $rent->diskon = $request->diskon;
                $rent->diskon_membership = $request->diskon_membership;
                $rent->total_price = $request->total_price;
                $rent->save();

                $user = Auth::user();

                // Tentukan venue_id dari field pada rent
                $venueId = $rent->field->venue_id;

                // Simpan log transaksi poin
                $pointTransaction = new PointTransaction();
                $pointTransaction->user_id = $user->id;
                $pointTransaction->rent_id = $rent->id;
                $pointTransaction->venue_id = $venueId;
                $pointTransaction->point_earned = $request->point_earned;
                $pointTransaction->point_spent = $request->point_spent;
                $pointTransaction->save();

                // Update / buat saldo poin per user + venue
                $pointBalance = PointBalance::where('user_id', $user->id)
                    ->where('venue_id', $venueId)
                    ->first();

                if (!$pointBalance) {
                    $pointBalance = new PointBalance();
                    $pointBalance->user_id = $user->id;
                    $pointBalance->venue_id = $venueId;
                    $pointBalance->point_balance = 0;
                }

                $pointBalance->point_balance += $request->point_earned;
                $pointBalance->point_balance -= $request->point_spent;
                $pointBalance->save();

                session()->forget('kode');
                return redirect()->route('customer.booking.index')
                    ->with('success', __('toast.create.success.message'));
            } else {
                return redirect()->back()->with('error', 'Batas waktu pembayaran telah berakhir');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('toast.create.failed.message'));
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
