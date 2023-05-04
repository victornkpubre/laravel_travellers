<?php

namespace App\Http\Resources;

use App\Http\Resources\FestivalResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FestivalResource extends JsonResource
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
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            'people' => $this->people,
            'img' => $this->img,
            'location' => $this->location,
            'activities' => $this->activities
        ];
    }
}
