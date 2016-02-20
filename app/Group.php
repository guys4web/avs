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

}