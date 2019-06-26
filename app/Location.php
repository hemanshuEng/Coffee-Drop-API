<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function Timetable()
    {
        return $this->hasMany('App\Timetable');
    }
}
