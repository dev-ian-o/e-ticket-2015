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

	Route::get('/', 			function(){ return View::make('admin.index'); })->before('auth');
	Route::get('/home', 		function(){ return View::make('admin.home'); })->before('auth');
	Route::get('/users', 		function(){ return View::make('admin.users'); })->before('auth');
	Route::get('/user-group', 		function(){ return View::make('admin.user-group'); })->before('auth');
	Route::get('/students', 	function(){ return View::make('admin.students'); })->before('auth');
	Route::get('/tickets', 		function(){ return View::make('admin.tickets'); })->before('auth');
	Route::get('/events', 		function(){ return View::make('admin.events'); })->before('auth');
	Route::get('/design', 	function(){ return View::make('admin.design'); })->before('auth');
	Route::get('/registration', function(){ return View::make('admin.registration'); })->before('auth');
	Route::get('/accounting', 	function(){ return View::make('admin.accounting'); })->before('auth');
});

Route::group(array('prefix' => 'ui-admin'), function()
{
	 Route::get('/', function(){ return View::make('ui-admin.index'); });
	 // Route::get('/', function(){ return View::make('ui-admin.ui-buttons');});

});