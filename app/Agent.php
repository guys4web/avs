<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'mobile_phone', 'office_phone', 'email'];

    public function service()
    {
        return $this->belongsToMany('App\Service', 'service_visas', 'visa_id', 'service_id');
    }

    public function passenger()
    {
        return $this->belongsToMany("App\Passenger","agent_id","id");
    }

}