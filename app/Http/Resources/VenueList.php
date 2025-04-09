<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->updated_at == NULL){
            $date = $this->created_at->format('d-m-Y / H:i');
        }else{
            $date = $this->updated_at->format('d-m-Y / H:i');
        }
        $owner = $this->owner->first_name." ".$this->owner->last_name;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'date' => $date,
            'owner' => $owner
        ];
    }
}
