<?php

class Company extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'companies';

	protected $fillable = array('name','street','zip','place', 'email', 'website');

	public function priorities()
    {
        return $this->belongsToMany('Priority');
    }

	public function topics()
    {
        return $this->belongsToMany('Topic');
    }

	public function ratings()
    {
        return $this->hasMany('Rating');
    }


}