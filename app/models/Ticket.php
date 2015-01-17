<?php

class Ticket extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tickets';

	protected $fillable = array('path','filename','event_id');

}
