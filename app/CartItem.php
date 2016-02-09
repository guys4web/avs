<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function passengers()
    {
        return $this->belongsToMany('App\Passenger','cartitems_passengers', 'cartitems_id', 'passenger_id');
    }
}
