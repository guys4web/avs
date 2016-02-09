<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model{

     protected $fillable = ['first_name','last_name','gender','birthdate','passport_num','passport_expirate'];

     public function cartitem()
     {
         return $this->belongsToMany('App\Cartitem','cartitems_passengers', 'passenger_id', 'cartitems_id');
     }

}
