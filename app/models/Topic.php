<?php

class Topic extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'topics';
	protected $fillable = array('name', 'description');

	public function companies()
    {
        return $this->belongsToMany('Company');
    }

}