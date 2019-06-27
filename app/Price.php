<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     *  get the price for coffeecup
     */
    public function coffeecup()
    {
        return $this->belongsTo('App\Coffeecup');
    }
}
