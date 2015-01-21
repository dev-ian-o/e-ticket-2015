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
	 Route::get('/', function(){
	 	return View::make('admin.index');
	 });

	 Route::get('/', function(){
	 	return View::make('admin.ui-buttons');
	 });


    
});