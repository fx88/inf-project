<?php

class TopicController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$topics = Topic::all();
		$data['topics'] = $topics;
		return View::make('topic.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$availableCompanies = Company::all();
		$data['availableCompanies'] = $availableCompanies;
		return View::make('topic.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$inputData = Input::all();
		$topic = Topic::create($inputData);
		
		if(isset($inputData['company']))
		{
			$addCompanies = array();

			$companies = Company::whereIn('name', $inputData['company'])->get(array('id'));

			foreach($companies as $company)
			{
				array_push($addCompanies, $company['id']);
			}

			$topic->companies()->sync($addCompanies);
		}

		return Redirect::action('TopicController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$topic = Topic::with(array('companies'))->find($id);
		$data['topic'] = $topic;
		return View::make('topic.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$availableCompanies = Company::all();
		$data['availableCompanies'] = $availableCompanies;
		
		$topic = Topic::with(array('companies'))->find($id);
		$data['topic'] = $topic;
		return View::make('topic.edit', $data);
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

		$topic = Topic::find($id);
		$topic->name = (isset($inputData['name'])) ? $inputData['name'] : $topic->name;
		$topic->save();
		
		if(isset($inputData['company']))
		{
			$addCompanies = array();

			$companies = Company::whereIn('name', $inputData['company'])->get(array('id'));

			foreach($companies as $company)
			{
				array_push($addCompanies, $company['id']);
			}

			$topic->companies()->sync($addCompanies);
		}

		return Redirect::action('TopicController@show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$topic = Topic::find($id);
		$topic->companies()->sync(array());
		$topic->delete();

		return Redirect::action('TopicController@index');
	}

}