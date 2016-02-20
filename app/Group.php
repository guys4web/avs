<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'travel_date'];

    public function agent()
    {
        return $this->belongsToMany('App\Agent', 'agent_groups', 'group_id', 'agent_id');
    }

    public function passenger()
    {
        return $this->belongsToMany('App\Passenger', 'group_passengers', 'group_id', 'passenger_id');
    }

}