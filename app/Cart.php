<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->hasOne("App\Order");
    }

    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }

}
