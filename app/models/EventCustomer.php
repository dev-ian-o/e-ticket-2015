<?php

class EventCustomer extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'event_customers';
	protected $fillable = array('event_id','customer_id','ticket_no','account_status','balance');


}
