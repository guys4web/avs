<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['passenger_name', 'carrier', 'tracking_num'];

    public function document()
    {
        return $this->hasMany('App\Document');
    }

    public function passenger()
    {
        return $this->belongsTo('App\Passenger');
    }

}