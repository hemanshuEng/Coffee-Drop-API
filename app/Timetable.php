<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    /**
     * get timetable for location
     */
    public function Location()
    {
        return $this->belongsTo('App\Location');
    }
}
