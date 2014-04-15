<?php

class Priority extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'priorities';
	protected $fillable = array('name','description', 'short');

	public function companies()
    {
        return $this->belongsToMany('Company');
    }

}