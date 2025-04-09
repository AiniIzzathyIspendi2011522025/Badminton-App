<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodDetail;

class PaymentMethodController extends Controller
{
    public function addPaymentMethod(Request $request){
        $datas = PaymentMethod::whereIn('id', $request->id)->get();
            if($request->venue_id){
            foreach($datas as $data){
                $detail = PaymentMethodDetail::where('payment_method_id', $data->id)
                                            ->where('venue_id', $request->venue_id)
                                            ->first();
                if($detail){
                $data->no_rek = $detail->no_rek;
                }else{
                $data->no_rek = 'null';
                }
            }
        }
        return response()->json($datas);
    }
}