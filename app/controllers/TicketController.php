<?php

class TicketController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Ticket::get());
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
		// ('path')
		// ('filename')
		// ('event_id')
		// Ticket::create(array(
  //           'title' => Request::get('title'),

  //       ));
		
		
		// return Response::json(array('success'=> true));
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
		// $event = Ticket::find($id);
		// $event->design_id = Request::get('design_id');
		// $event->title = Request::get('title');
		// $event->description = Request::get('description');
  //       $event->barcode_no_start = Request::get('barcode_no_start');
  //       $event->barcode_no_end = Request::get('barcode_no_end');
  //       $event->schedule = Request::get('schedule');
  //       $event->ticket_price = Request::get('ticket_price');
		// $event->save();

		// // return Redirect::to('admin/users');
		// return Response::json(array('success'=> true));
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
		// $event = Ticket::find($id);
		// $event->deleted_at = date('Y-m-d h:m:s');
		// $event->save();
		// // return Redirect::to('admin/users');
		// return Response::json(array('success'=> true));
	}


}
