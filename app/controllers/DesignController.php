<?php

class DesignController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Design::where('designs.deleted_at', '=', NULL)
  //       ->leftJoin('user_groups', 'users.user_group_id', '=', 'user_groups.id')
  //       ->select('*','users.id','users.deleted_at','users.created_at','users.updated_at')
  //       ->get();
		$data = Design::get();	
		return Response::json($data);
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
		$design_path = "";
		$file_name = str_random(100);

		$code = Request::get('code'); // added

		$path = public_path().'\\designs\\'.$file_name.'.svg'; // added
		File::put($path, $code); //

		$design_path = URL::to('designs/'.$file_name.'.svg'); // added

		if(!DB::table('designs')->where("id",Request::get('id'))->pluck('id'))
		{
			Design::create(array(
	            'design_name' => Request::get('design_name'),
	            'design_path' => $design_path,
	            'json_object'    => Request::get('json_object')
	        ));
		}else{

			$user = Design::find(Request::get('id'));
			$user->design_path = $design_path;
			$user->design_name = Request::get('design_name');
			$user->json_object = Request::get('json_object');
			$user->save();
		}


		return Response::json(array('success'=> true,'id'=> DB::table('designs')->where("design_path",$design_path)->pluck('id')));
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
