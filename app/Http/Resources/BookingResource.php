<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "date_created" => $this->created_at,
            "client_id" => $this->client_id,
            "client" => $this->client,
            'places' => $this->places,
            'festivals' => $this->festivals,
            'activities'=> $this->activities
        ];
    }
}
