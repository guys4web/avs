<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
   
}
