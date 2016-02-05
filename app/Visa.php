<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    public function service()
    {
        return $this->belongsToMany('App\Service', 'service_visas', 'visa_id', 'service_id');
    }
   
}