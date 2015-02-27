<?php

class Event extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';
	protected $fillable = array('design_id', 'title', 'description', 'barcode_no_start', 'barcode_no_end', 'schedule', 'ticket_price');

}
