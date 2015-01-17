<?php

class DesignController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $data = Design::get();	
		// return Response::json($data);
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

		if(!DB::table('designs')->where("id",Request::get('id'))->pluck('id'))
		{
			Design::create(array(
	            'event_id' => Request::get('event_id'),
	            'design_name' => Request::get('design_name'),
	            'json_object'    => Request::get('json_object')
	        ));
		}else{
			$user = Design::find(Request::get('id'));
			$user->event_id = Request::get('event_id');
			$user->design_name = Request::get('design_name');
			$user->json_object = Request::get('json_object');
			$user->save();
		}

		return Response::json(array('success'=> true));



	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Design::where('id','=', $id)->get();
		return Response::json($data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		Design::firstOrCreate(Request::get());
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
		//
	}


}
