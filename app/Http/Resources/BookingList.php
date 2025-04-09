<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Rent;
use Carbon\Carbon;

class BookingList extends JsonResource
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
        $expired = 0;
        if($this->RentPayment){
            if($this->status == 1){
                $status = '<p><span class="badge badge-default">Sedang Diajukan</span></p>';
            }elseif($this->status == 2){
                $status = '<p><span class="badge badge-primary">Dibooking</span></p>';
            }elseif($this->status == 3){
                $status = '<p><span class="badge badge-danger">Booking Ditolak</span></p>';
            }else{
                $status = '<p><span class="badge badge-info">Selesai</span></p>';
            }
        }else{
            if($this->status == 1){
                if(Carbon::now() >= Carbon::parse($this->created_at)->addMinutes(10)){
                    $expired = 1;
                    $status = '<p><span class="badge badge-warning">Expired</span></p>';
                }else{
                    $status = '<p><span class="badge badge-secondary">Menunggu pembayaran</span></p>';
                }
            }else{
                if($this->status == 2){
                    $status = '<p><span class="badge badge-primary">Dibooking</span></p>';
                }elseif($this->status == 3){
                    $status = '<p><span class="badge badge-danger">Booking Ditolak</span></p>';
                }else{
                    $status = '<p><span class="badge badge-info">Selesai</span></p>';
                }
            }

        }


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
            'history' => $history,
            'expired' => $expired
        ];
    }
}
