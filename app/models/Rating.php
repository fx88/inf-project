<?php

class Rating extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ratings';
	
	protected $fillable = array('company_id','rating','comment');


	public function company()
    {
        return $this->belongsTo('Company');
    }


}