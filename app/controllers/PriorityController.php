<?php

class PriorityController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$priorities = Priority::orderBy('name', 'asc')->get();
		$data['priorities'] = $priorities;
		return View::make('priority.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$availableCompanies = Company::orderBy('name', 'asc')->get();
		$data['availableCompanies'] = $availableCompanies;

		return View::make('priority.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputData = Input::all();
		
		$priority = Priority::create($inputData);
		
		if(isset($inputData['company']))
		{
			$addCompanies = array();

			$companies = Company::whereIn('name', $inputData['company'])->get(array('id'));

			foreach($companies as $company)
			{
				array_push($addCompanies, $company['id']);
			}

			$priority->companies()->sync($addCompanies);
		}
		
		return Redirect::action('PriorityController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$priority = Priority::with(array('companies'))->find($id);
		$data['priority'] = $priority;
		return View::make('priority.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$availableCompanies = Company::orderBy('name', 'asc')->get();
		$data['availableCompanies'] = $availableCompanies;
		
		$priority = Priority::with(array('companies'))->find($id);
		$data['priority'] = $priority;
		return View::make('priority.edit', $data);
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
		
		$priority = Priority::find($id);
		$priority->name = (isset($inputData['name'])) ? $inputData['name'] : $priority->name;
		$priority->short = (isset($inputData['short'])) ? $inputData['short'] : $priority->short;
		$priority->save();
		
		$addCompanies = array();

		if(isset($inputData['company']))
		{
			$companies = Company::whereIn('name', $inputData['company'])->orderBy('name', 'asc')->get(array('id'));
	
			foreach($companies as $company)
			{
				array_push($addCompanies, $company['id']);
			}
		}
		else
		{
			$addCompanies = array();
		}
		

		$priority->companies()->sync($addCompanies);

		return Redirect::action('PriorityController@show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$priority = Priority::find($id);
		$priority->companies()->sync(array());
		$priority->delete();

		return Redirect::action('PriorityController@index');
	}

}