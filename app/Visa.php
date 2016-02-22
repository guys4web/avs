<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    public function service()
    {
        return $this->belongsToMany('App\Service', 'service_visas', 'visa_id', 'service_id');
    }

    public function products()
    {
        return $this->hasMany("App\Product","visa_id","id");
    }

    public function requirement()
    {
        return $this->belongsToMany('App\Requirement', 'visa_requirements', 'visa_id', 'requirement_id');
    }

}
