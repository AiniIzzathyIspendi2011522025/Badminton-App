<?php
foreach($request_detail as $detail){
    $key_day = array_keys($request_detail);
    //echo "key_day"; 
    //echo $key_day; 
    for($i = 0; $i < count($detail); $i++){
        //echo "detail[i]"; 
        //echo $detail[$i]; 
        for($x = 0; $x < count($detail[$i]); $x++){
            //dd(count($request_price[$key_day[1]]));
            //for($y = 0; $y < count($request_price[$key_day[$i]]); $y++){\
            foreach($request_price as $price){
                echo "detail[$i][$x]"; 
                echo $detail[$i][$x]; 
                
                //dd($price);
                // $openingHour = OpeningHour::where('venue_id', $id)
                // ->where('day_id', $key_day[$i])
                // ->where('hour_id', $detail[$i][$x])
                // ->first();

                //$a = $field->id;
                //dd($request->price[$key_day[$i]][$y]);
                // $detail = new OpeningHourDetail;
                // $detail->field_id = $field->id;
                // $detail->opening_hour_id = 1;
                // $detail->price = $price[0];
                // $detail->save();
            }
            //}
        }
    }
}

?>