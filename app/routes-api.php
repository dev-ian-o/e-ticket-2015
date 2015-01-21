<?php

// Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('users', 'UserController');
    Route::resource('user-groups', 'UserGroupController');
    Route::resource('designs', 'DesignController');
    
});



Route::group(array('prefix' => 'admin'), function()
{
	Route::get('/', 			function(){ return View::make('admin.index'); });
	Route::get('/home', 		function(){ return View::make('admin.home'); });
	Route::get('/students', 	function(){ return View::make('admin.students'); });
	Route::get('/tickets', 		function(){ return View::make('admin.tickets'); });
	Route::get('/events', 		function(){ return View::make('admin.events'); });
	Route::get('/viewport', 	function(){ return View::make('admin.viewport'); });
	Route::get('/registration', function(){ return View::make('admin.registration'); });
	Route::get('/accounting', 	function(){ return View::make('admin.accounting'); });
	
});

Route::group(array('prefix' => 'ui-admin'), function()
{
	 Route::get('/', function(){ return View::make('ui-admin.index'); });
	 Route::get('/', function(){ return View::make('ui-admin.ui-buttons');});

});