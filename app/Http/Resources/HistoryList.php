<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = $this->first_name." ".$this->last_name;
        
        $time = strtotime($this->date);
        $date = date('d-m-Y',$time);

        $rent = Rent::find($this->id);
        $schedule = $rent->order('asc').'-'.$rent->order('desc');
        if($rent->History){
            $history = true;
        }else{
            $history = false;
        }
        return [
            'id' => $this->id,
            'name' => $this->tenant_name,
            'date' => $date,
            'venue' => $this->field->venue->name,
            'field' => $this->field->name,
            'time' => $schedule,
            'p_status' => $status,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'history' => $history
        ];
    }
}
