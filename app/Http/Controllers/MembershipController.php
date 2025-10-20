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
use Illuminate\Support\Str;

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
                $start = $today->copy();
                $end   = $today->copy()->addMonthsNoOverflow($months);

                $shortVenueName = strtoupper(substr(preg_replace('/\s+/', '', $venue->name), 0, 3));

                do {
                    $rand3 = str_pad((string) random_int(0, 999), 3, '0', STR_PAD_LEFT);
                    $customId = $shortVenueName . '-' . now()->format('Ymd') . '-' . $rand3;
                } while (Membership::where('id', $customId)->exists());

                $membership = Membership::create([
                    'id'                => $customId,
                    'user_id'           => $userId,
                    'venue_id'          => $venue->id,
                    'start_date'        => $start->toDateString(),
                    'end_date'          => $end->toDateString(),
                    'payment'           => $fileName,
                    'membership_status' => 2,
                    'count_month'       => $months,
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
                // tanggal & count_month sudah ditentukan saat pay()
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

            // tandai REJECTED agar jejak audit tersimpan
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

    public function checkMembership(Request $request)
    {
        $validated = $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'id'       => 'required|string|max:50',
        ]);

        $venueId = (int) $validated['venue_id'];
        $id      = strtoupper(trim($validated['id']));

        // (Opsional) Batasi venue milik owner yang login:
        // $ownerVenueIds = Auth::user()->venues()->pluck('id')->toArray();
        // if (!in_array($venueId, $ownerVenueIds)) {
        //     return back()->withErrors(['venue_id' => 'Venue tidak valid untuk akun Anda.'])->withInput();
        // }

        $membership = Membership::where('id', $id)->where('venue_id', $venueId)->where('membership_status', 1)->first();

        if (!$membership) {
            return back()
                ->withErrors(['id' => 'Membership tidak ditemukan atau tidak aktif pada venue terpilih.'])
                ->withInput();
        }

        session()->put('booking.membership', [
            'id'         => (string) $membership->id,
            'user_id'    => (int) $membership->user_id,
            'user_name'  => (string) ($membership->user->first_name . ' ' . $membership->user->last_name ?? ''),
            'venue_id'   => (int) $membership->venue_id,
            'venue_name' => (string) ($membership->venue->name ?? ''),
            'status'     => (int) $membership->membership_status,
            'start_date' => (string) ($membership->start_date ?? ''),
            'end_date'   => (string) ($membership->end_date ?? ''),
            'membership_discount' => (int) $membership->venue->membership_discount
        ]);

        return back()->with('success_message', 'Membership ditemukan: ' . $membership->id);
    }

    public function cancelMembership()
    {
        // Hapus session membership
        session()->forget('booking.membership');

        return back()->with('info_message', 'Membership telah dibatalkan.');
    }

}
