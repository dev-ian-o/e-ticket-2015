<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::where('deleted_at', '=', NULL)->get();
		// return Response::json(array('success'=> 'ok','data'=> $users));
		return Response::json($users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


	}	


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		User::create(array(
            'username' => Request::get('email'),
            'password' => Hash::make(Request::get('password')),
            'email'    => Request::get('email'),
            'user_group_id' => 1
        ));
		
		// return Response::json(array('success'=> true));
		return Redirect::to('admin/users');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = User::where('id','=', $id)->get();
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
		$arr = [
			'user_group_id' => Request::get('user_group_id'),
			'username' => Request::get('email'),
			'email' => Request::get('email'),
			'password' => Hash::make(Request::get('password')),
		];
		$user = User::where('id',Request::get('id'))->update($arr);
		return Redirect::to('admin/users');
		
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
		return Redirect::to('admin/users');
	}


}
