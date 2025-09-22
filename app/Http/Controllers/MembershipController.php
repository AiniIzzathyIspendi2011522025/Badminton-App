<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{
    /**
     * Detail Status :
     * 1 = ACTIVE, 2 = WAITING_CONFIRMATION, 3 = REJECTED
     */

    public function index($id)
    {
        $venue = Venue::findOrFail($id);
        return view('backend.membership.index', compact('venue'));
    }

    public function pay(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'duration'        => 'required|in:1,12',
            'payment_method'  => 'required|exists:payment_method_details,id',
            'payment'         => 'required|image|max:4096', // 4MB
        ]);

        $userId  = Auth::id();
        $months  = (int) $validated['duration']; // 1 atau 12
        $today   = Carbon::today();              // gunakan today() agar konsisten
        $venue   = Venue::findOrFail($id);

        $dir = public_path() . '/images/payment';
        if ($request->hasFile('payment')) {
            $file     = $request->file('payment');
            $ext      = $file->getClientOriginalExtension();
            $fileName = 'pay_' . $userId . '_' . now()->timestamp . '.' . $ext;
            if ($file) { $file->move($dir, $fileName); }
        }

        DB::beginTransaction();
        try {
            // Ambil membership yang ada (untuk venue & user ini)
            $membership = Membership::where('user_id', $userId)
                ->where('venue_id', $venue->id)
                ->lockForUpdate() // hindari race ketika user double submit
                ->first();

            if ($membership) {
                // Jika sudah ACTIVE dan masih berjalan, perpanjang dari end_date
                // Jika sudah lewat, mulai dari hari ini
                $baseStart = $today->copy();
                if ($membership->membership_status === 1 && $membership->end_date && Carbon::parse($membership->end_date)->isFuture()) {
                    $baseStart = Carbon::parse($membership->end_date);
                }

                $newStart = $baseStart->copy();
                $newEnd   = $baseStart->copy()->addMonthsNoOverflow($months);

                // Update untuk menunggu konfirmasi (agar owner bisa review)
                $membership->start_date         = $newStart->toDateString();
                $membership->end_date           = $newEnd->toDateString();
                $membership->membership_status  = 2; // WAITING_CONFIRMATION
                $membership->payment            = $fileName ?? $membership->payment;

                $membership->count_month        = ($membership->count_month ?? 0) + $months;

                $membership->save();
            } else {
                // Buat membership baru (menunggu konfirmasi)
                $start = $today->copy();
                $end   = $today->copy()->addMonthsNoOverflow($months);

                $membership = Membership::create([
                    'user_id'            => $userId,
                    'venue_id'           => $venue->id,
                    'start_date'         => $start->toDateString(),
                    'end_date'           => $end->toDateString(),
                    'payment'            => $fileName,
                    'membership_status'  => 2, // WAITING_CONFIRMATION
                    'count_month'        => $months,
                ]);
            }

            DB::commit();
            return redirect('/customer/profil')->with('success', 'Pengajuan membership berhasil dikirim. Menunggu konfirmasi.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            Log::error('Membership pay error', ['error' => $th->getMessage()]);
            return back()->withErrors('Terjadi kesalahan saat memproses pembayaran.');
        }
    }

    public function owner()
    {
        $userId = auth()->id();

        // Ambil semua membership untuk venue milik owner dalam satu query
        $memberships = Membership::query()
            ->join('venues', 'memberships.venue_id', '=', 'venues.id')
            ->join('users', 'memberships.user_id', '=', 'users.id')
            ->where('venues.user_id', $userId)
            ->select(
                'venues.name as nama_venue',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as nama_member"),
                'memberships.start_date',
                'memberships.end_date',
                'memberships.membership_status',
                'memberships.id as membership_id',
                'memberships.count_month'
            )
            ->orderByDesc('memberships.updated_at')
            ->get();

        return view('backend.owner.manage_membership.index', compact('memberships'));
    }

    public function show($id)
    {
        $membership = Membership::findOrFail($id);
        return view('backend.owner.manage_membership.show', compact('membership'));
    }

    public function confirm($id)
    {
        DB::beginTransaction();
        try {
            $membership = Membership::lockForUpdate()->findOrFail($id);

            // Jika sudah ACTIVE, tidak perlu ubah tanggal atau count_month lagi
            if ((int)$membership->membership_status !== 1) {
                // Pada alur baru, tanggal & count_month sudah ditentukan saat pay()
                // Jadi di sini cukup mengaktifkan saja
                $membership->membership_status = 1; // ACTIVE
                $membership->save();
            }

            DB::commit();
            return redirect()->route('owner.membership.owner')
                ->with('success', __('toast.confirmMember.success.message'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Membership confirm error', ['error' => $th->getMessage()]);
            return back()->withErrors('Gagal mengkonfirmasi membership.');
        }
    }

    public function reject($id)
    {
        DB::beginTransaction();
        try {
            $membership = Membership::lockForUpdate()->findOrFail($id);

            // Disarankan jangan delete, tandai REJECTED agar jejak audit tersimpan
            $membership->membership_status = 3; // REJECTED
            $membership->save();

            DB::commit();
            return redirect()->route('owner.membership.owner')
                ->with('success', __('toast.rejectMember.success.message'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Membership reject error', ['error' => $th->getMessage()]);
            return back()->withErrors('Gagal menolak membership.');
        }
    }
}
