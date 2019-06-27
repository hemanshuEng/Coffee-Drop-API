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

        $timetable = $this->timetable->map(function ($item, $key) {
            $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
            if ($item->open == null) {
                return ['day' => $days[$item->day], 'open' => 'CLOSED', 'closed' => 'CLOSED'];
            } else {
                return ['day' => $days[$item->day], 'open' => $item->open, 'closed' => $item->closed];
            }
        });


        return [
            'address' => [
                'distrist' => $this->district,
                'county' => $this->county,
            ],
            'postcode' => $this->postcode,
            'geolocation' => [
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ],
            'hours' => $timetable

        ];
    }
}
