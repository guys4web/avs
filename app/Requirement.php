<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requirements';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];

    public function visas()
    {
        return $this->belongsToMany('App\Visa', 'visa_requirements', 'requirement_id', 'visa_id');
    }

}