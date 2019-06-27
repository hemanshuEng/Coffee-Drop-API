<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coffeecup extends Model
{
    public function price()
    {
        /**
         * Get the price record associated with the coffeecup
         */
        return $this->hasMany('App\Price');
    }
}
