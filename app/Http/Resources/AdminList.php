<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminList extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $name,
            'email' => $this->user->email,
            'handphone' => $this->handphone
        ];
    }
}