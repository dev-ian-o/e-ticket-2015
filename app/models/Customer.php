<?php

class Customer extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers';
	protected $fillable = array('firstname','lastname','gender','birthdate','year','section','course','work');


}
