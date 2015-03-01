<?php

// Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('users', 'UserController');
    Route::resource('user-groups', 'UserGroupController');
    Route::resource('designs', 'DesignController');
    Route::resource('events', 'EventController');
    Route::resource('tickets', 'TicketController');
    Route::resource('event_customers', 'EventCustomerController');
    Route::resource('customers', 'CustomerController');
    
});



Route::group(array('prefix' => 'admin'), function()
{

	Route::get('/', 			function(){ return View::make('admin.index'); })->before('auth');
	Route::get('/home', 		function(){ return View::make('admin.home'); })->before('auth');
	Route::get('/users', 		function(){ return View::make('admin.users'); })->before('auth');
	Route::get('/user-group', 	function(){ return View::make('admin.user-group'); })->before('auth');
	// Route::get('/students', 	function(){ return View::make('admin.students'); })->before('auth');
	Route::get('/customers', 	function(){ return View::make('admin.customers'); })->before('auth');
	Route::get('/tickets/assign/{id}', 	function($id){ 
		$event = Event::where('id','=', $id)->get();
		if(isset($event[0]))
			return View::make('admin.assign-tickets', array('id' => $id)); 
		else
			return Redirect::to('/admin/events'); 
	})->before('auth');
	Route::get('/tickets', 		function(){ return View::make('admin.tickets'); })->before('auth');

	Route::get('/tickets/{id}', 		function($id){ 
		$event = Event::where('id','=', $id)->get();
		if(isset($event[0]))
			return View::make('admin.tickets', array('id' => $id)); 
		else
			return Redirect::to('/admin/tickets');
	})->before('auth');
	Route::get('/events', 		function(){ return View::make('admin.events'); })->before('auth');
	Route::get('/design', 		function(){ return View::make('admin.design'); })->before('auth');
	Route::get('/registration', function(){ return View::make('admin.registration'); })->before('auth');
	Route::get('/registration/{id}', 	function($id){ 
		$event = Event::where('id','=', $id)->get();
		if(isset($event[0]))
			return View::make('admin.registration', array('id' => $id)); 
		else
			return Redirect::to('/admin/registration'); 
	})->before('auth');	
	Route::get('/accounting', function(){ return View::make('admin.accounting'); })->before('auth');
	Route::get('/accounting/{id}', 	function($id){ 
		$event = Event::where('id','=', $id)->get();
		if(isset($event[0]))
			return View::make('admin.accounting', array('id' => $id)); 
		else
			return Redirect::to('/admin/accounting'); 
	})->before('auth');
	Route::get('/add/design', 	function(){ return View::make('admin.design-add'); })->before('auth');
	
	Route::get('/design/{id}', 		function($id){ 
		$design = Design::where('id','=', $id)->get();
		if(isset($design[0]))
			return View::make('admin.design', array('id' => $id)); 
		else
			return Redirect::to('/admin/design'); 
	})->before('auth');

});

Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});

Route::group(array('prefix' => 'ui-admin'), function()
{
	 Route::get('/', function(){ return View::make('ui-admin.index'); });
	 // Route::get('/', function(){ return View::make('ui-admin.ui-buttons');});

});