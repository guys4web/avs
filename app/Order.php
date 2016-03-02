<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{

    protected $casts = [
        'billing_data' => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo('App\Cart','cart_id');
    }

    public function user()
    {
      return $this->belongsTo('App\User','user_id');
    }

    public function payment()
    {
        $cart = $this->cart;
        
        if($cart->payment_type=="check")
        {
            return "Check" ;
        }
        else if($cart->payment_type=="money")
        {
            return "Order money" ;
        }
        else
        {
            return "Credit Card" ;
        }
    }



}
