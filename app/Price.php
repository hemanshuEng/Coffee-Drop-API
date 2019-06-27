<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function coffeecup()
    {
        return $this->belongsTo('App\Coffeecup');
    }
}
