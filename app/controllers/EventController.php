<?php

class EventController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	// $events = Event::where('events.deleted_at', '=', NULL)
 //        ->leftJoin('designs', 'events.design_id', '=', 'designs.id')
 //        ->select('*','events.id','events.deleted_at','events.created_at','events.updated_at')
 //        ->get();
	// 	return Response::json($events);
		return Response::json(Event::get());

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
		Event::create(array(
            'title' => Request::get('title'),
            'design_id' => Request::get('design_id'),
            'description' => Request::get('description'),
            'barcode_no_start' => Request::get('barcode_no_start'),
            'barcode_no_end' => Request::get('barcode_no_end'),
            'schedule' => Request::get('schedule'),
            'ticket_price' => Request::get('ticket_price'),
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
		$event = Event::find($id);
		$event->design_id = Request::get('design_id');
		$event->title = Request::get('title');
		$event->description = Request::get('description');
        $event->barcode_no_start = Request::get('barcode_no_start');
        $event->barcode_no_end = Request::get('barcode_no_end');
        $event->schedule = Request::get('schedule');
        $event->ticket_price = Request::get('ticket_price');
		$event->save();

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
		$event = Event::find($id);
		$event->deleted_at = date('Y-m-d h:m:s');
		$event->save();
		// return Redirect::to('admin/users');
		return Response::json(array('success'=> true));
	}


}
