<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		$data['users'] = $users;
		return View::make('user.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputData = Input::all();
		
		$user = User::create($inputData);
		
		return Redirect::action('UserController@show', $user->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		$data['user'] = $user;
		return View::make('user.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		$data['user'] = $user;
		return View::make('user.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$inputData = Input::all();
		
		$user = User::find($id);
		$user->fill($inputData);
		$user->password = Hash::make($inputData['password']);
		$user->save();
		
		return Redirect::action('UserController@show', $user->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		return Redirect::action('UserController@index');
	}

	public function login()
	{
		$email 		= Input::get('email');
		$password 	= Input::get('password');

		$auth = Auth::attempt(array('email' => $email, 'password' => $password));

		if($auth)
		{
			return Redirect::intended('user');
		}
		else
		{
			return Redirect::action('UserController@loginForm');
		}


	}

	public function logout()
	{
		Auth::logout();
		return Redirect::action('CompanyController@index');
	}

	public function loginForm()
	{
		return View::make('user.login');
	}

}