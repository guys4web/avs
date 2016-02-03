<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
 
    public function visas()
    {
        return $this->hasMany('App\Visa');
    }
}
