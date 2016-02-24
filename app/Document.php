<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'package_id', 'passenger_id', 'doc_id', 'exp_date'];

    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function passenger()
    {
        return $this->belongsTo('App\Passenger');
    }

}