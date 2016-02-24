<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model{

     protected $fillable = ['first_name','last_name','gender','birthdate','passport_num','passport_expirate'];

     public function cartitem()
     {
         return $this->belongsToMany('App\Cartitem','cartitems_passengers', 'passenger_id', 'cartitems_id');
     }

     public function group()
     {
         return $this->belongsToMany('App\Group','group_passengers', 'passenger_id', 'group_id');
     }

     public function package()
    {
        return $this->hasMany('App\Package');
    }

    public function document()
    {
        return $this->hasMany('App\Document');
    }

}
