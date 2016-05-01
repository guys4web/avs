<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "service_visas" ;

    public function visa()
    {
        return $this->belongsTo('App\Visa',"visa_id");
    }

    public function service()
    {
        return $this->belongsTo('App\Service',"service_id");
    }
    
    public function nbCartItem()
    {
        return CartItem::where("product_id",$this->id)->count();
    }

}
