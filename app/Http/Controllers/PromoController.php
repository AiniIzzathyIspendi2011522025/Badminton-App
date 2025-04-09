<?php


namespace App\Http\Controllers;


use App\Models\Promo;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
{
    public function index()
    {

        // Mengambil owner yang sedang login
        $user = Auth::user();
        try {
            $promo = Promo::where('user_id', $user->id)->get();
            return view('backend.owner.manage_promo.index', compact('promo'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('home.index')->with('error', 'You are not an owner.');
        }
    }


    public function create()
    {
        return view('backend.owner.manage_promo.create');
    }


    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'kode' => 'required|string',
                'diskon' => 'required'
            ]);

            $user = Auth::user();
            $user_id = $user->id;
            $kode = strtoupper($validated['kode']);
            $diskon = $validated['diskon'] / 100;

            Promo::create([
                'kode' => $kode,
                'diskon' => $diskon,
                'user_id' => $user_id
            ]);

            return redirect('/owner/promo');
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->back();
    }


    public function edit(Promo $promo)
    {
        return view('backend.owner.manage_promo.edit', compact('promo'));
    }


    public function update(Request $request, Promo $promo)
    {
        try {
            $promo = Promo::find($promo->id);
            $promo->kode = strtoupper($request->kode);
            $promo->diskon = $request->diskon / 100;
            $promo->save();
            return redirect('/owner/promo');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function check(Request $request)
    {
        $kode_promo = strtoupper($request->kode);
        $user_id = ($request->owner_id);
        $kode = Promo::where('kode', $kode_promo)->where('user_id', $user_id)->first();
        // dd($user_id);
        if (!$kode) {
            return redirect()->back()->withErrors('Kode Promo tidak valid, Coba lagi!');
        }

        session()->put('kode', [
            'name' => $kode->kode,
            'diskon' => $kode->diskon
        ]);

        return redirect()->back()->with('success_message', 'Kode Promo berhasil di gunakan');
    }

    public function delete()
    {

        session()->forget('kode');

        return redirect()->back()->with('success_message', 'Kode Promo Berhasil di hapus');
    }
}
