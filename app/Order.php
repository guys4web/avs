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



}
