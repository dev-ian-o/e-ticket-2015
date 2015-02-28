<?php

class CustomerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	// $events = Customer::where('events.deleted_at', '=', NULL)
 //        ->leftJoin('designs', 'events.design_id', '=', 'designs.id')
 //        ->select('*','events.id','events.deleted_at','events.created_at','events.updated_at')
 //        ->get();
	// 	return Response::json($events);
		return Response::json(Customer::get());

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		Customer::create(array(
    		'firstname' => Request::get('firstname'),
			'lastname' => Request::get('lastname'),
			'gender' => Request::get('gender'),
			'birthdate' => Request::get('birthdate'),
			'year' => Request::get('year'),
			'section' => Request::get('section'),
			'course' => Request::get('course'),
			'work' => Request::get('work'),
        ));
		
		
		return Response::json(array('success'=> true));
		// return Response::json(Request::get());

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$customer = Customer::find($id);
		$customer->firstname = Request::get('firstname');
		$customer->lastname = Request::get('lastname');
		$customer->gender = Request::get('gender');
		$customer->birthdate = Request::get('birthdate');
		$customer->year = Request::get('year');
		$customer->section = Request::get('section');
		$customer->course = Request::get('course');
		$customer->work = Request::get('work');
		$customer->save();

		// return Redirect::to('admin/users');
		return Response::json(array('success'=> true));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$event = Customer::find($id);
		$event->deleted_at = date('Y-m-d h:m:s');
		$event->save();
		// return Redirect::to('admin/users');
		return Response::json(array('success'=> true));
	}


}
