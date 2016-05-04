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
        return $this->belongsToMany('App\Visa', 'service_visas', 'service_id', 'visa_id');
    }

    public function getTitleAttribute() 
    {
    	return $this->attributes['name'] . ': ' . $this->attributes['min_process'] . ' - ' . $this->attributes['max_process']. ' Business Days ';
    }
    
    public function nbProduct()
    {
        return Product::where('service_id',$this->id)->count();
    }
}
