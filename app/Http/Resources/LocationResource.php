<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'postcode' => $this->postcode,
            'geolocation' => [
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ],
            'address' => [
                'distrist' => $this->district,
                'county' => $this->county,
            ]

        ];
    }
}
