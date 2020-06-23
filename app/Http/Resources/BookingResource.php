<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'field_id' => $this->field_id,
            'date' => $this->date,
            'time' => $this->time,
            'booked_at' => gmdate("Y-m-d H:i:s",strtotime($this->created_at)),
        ];
    }
}
