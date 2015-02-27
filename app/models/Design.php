<?php

class Design extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'designs';

	protected $fillable = array('design_name','event_id','json_object','design_path');

}
