<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
class CetakController extends Controller
{
    public function booking ($id){

        $rents = Rent::find($id);
        $qrcode = QrCode::size(100)->generate('http://localhost:8000/owner/booking/' . $rents->id . '/show');
        $data = [
            'rents' => $rents,
            'qrcode' => $qrcode
        ];
        // dd($data);
        // $pdf = PDF::loadView('backend.customer.manage_booking.invoice', $rents);
        $pdf = PDF::loadView('backend.customer.manage_booking.invoice', $data);

        return $pdf->download('Laporan Transaksi.pdf');

    }
}
