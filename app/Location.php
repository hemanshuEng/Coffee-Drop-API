<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Get the timetable record for location
     */
    public function Timetable()
    {
        return $this->hasMany('App\Timetable');
    }
}
