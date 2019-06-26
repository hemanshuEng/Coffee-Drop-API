<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    public function Location()
    {
        return $this->belongsTo('App\Location');
    }
}
