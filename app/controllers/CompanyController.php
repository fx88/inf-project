<?php

class CompanyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$availablePriorities = Priority::all();
		$data['availablePriorities'] = $availablePriorities;
		
		$availableTopics = Topic::all();
		$data['availableTopics'] = $availableTopics;
		
		
		
		$filterTopics = Input::get('topic');
		$filterTopics = ($filterTopics && !is_array($filterTopics)) ? explode(',', $filterTopics) : $filterTopics;
		$data['filterTopics'] = $filterTopics;
		
		$filterPriorities = Input::get('prio');
		$filterPriorities = ($filterPriorities && !is_array($filterPriorities)) ? explode(',', $filterPriorities) : $filterPriorities;
		$data['filterPriorities'] = $filterPriorities;
		
		$filterRating = Input::get('rate');
		$filterRating = ($filterRating && !is_array($filterRating)) ? explode(',', $filterRating) : $filterRating;
		$data['filterRating'] = $filterRating;
		
		$filterPage = Input::get('page');
		$filterPage = ($filterPage && !is_array($filterPage)) ? explode(',', $filterPage) : $filterPage;
		$data['filterPage'] = $filterPage;
		
		$query = Company::with(array('topics','priorities','ratings'));
		
		if($filterPage)
		{
			$query->where('name', $filterPage);
		}

		if($filterTopics)
		{
			$query->whereHas('topics', function($q) use ($filterTopics)
			{
			    $q->whereIn('name', $filterTopics);
			
			});
	
		}
		
		if($filterPriorities)
		{
			$query->whereHas('priorities', function($q) use ($filterPriorities)
			{
			    $q->whereIn('name', $filterPriorities);
			
			});
	
		}

		if($filterRating)
		{
			$query->ratings()->count();
	
		}
		
		$data['companies'] = $query->get();
		return View::make('company.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$availablePriorities = Priority::all();
		$data['availablePriorities'] = $availablePriorities;
		
		$availableTopics = Topic::all();
		$data['availableTopics'] = $availableTopics;
	
		return View::make('company.create',$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputData = Input::all();
		
		$company = Company::create($inputData);
		
		if(isset($inputData['prio']))
		{
			$addPriorities = array();

			$priorities = Priority::whereIn('name', $inputData['prio'])->get(array('id'))->toArray();

			foreach($priorities as $priority)
			{
				array_push($addPriorities, $priority['id']);
			}

			$company->priorities()->sync($addPriorities);
		}
		
		if(isset($inputData['topic']))
		{
			$addTopics = array();

			$topics = Topic::whereIn('name', $inputData['topic'])->get(array('id'))->toArray();

			foreach($topics as $topic)
			{
				array_push($addTopics, $topic['id']);
			}

			$company->topics()->sync($addTopics);
		}
		$company->save();
		
		return Redirect::action('CompanyController@show', $company->id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeRate($id)
	{
		$inputData = Input::all();
		$inputData['company_id'] = $id;

		$rating = Rating::create($inputData);
		
		return Redirect::action('CompanyController@show', $id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function destroyRate($id, $rateId)
	{
		$rating = Rating::where('company_id' , $id)->where('id' , $rateId)->first();;
		
		if($rating)
		{
			$rating->delete();
		}
		return Redirect::action('CompanyController@edit', $id);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = Company::with(array('ratings','topics'))->find($id);
		$data['company'] = $company;
		return View::make('company.show', $data);		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$availablePriorities = Priority::all();
		$data['availablePriorities'] = $availablePriorities;
		
		$availableTopics = Topic::all();
		$data['availableTopics'] = $availableTopics;
	
		$company = Company::with(array('ratings','topics'))->find($id);
		$data['company'] = $company;
		return View::make('company.edit', $data);
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
		
		$company = Company::find($id);
		
		$company->name = (isset($inputData['name'])) ? $inputData['name'] : $company->name;
		$company->street = (isset($inputData['street'])) ? $inputData['street'] : $company->street;
		$company->zip = (isset($inputData['zip'])) ? $inputData['zip'] : $company->zip;
		$company->place = (isset($inputData['place'])) ? $inputData['place'] : $company->place;
		$company->email = (isset($inputData['email'])) ? $inputData['email'] : $company->email;
		$company->website = (isset($inputData['website'])) ? $inputData['website'] : $company->website;
		
		if(isset($inputData['prio']))
		{
			$addPriorities = array();

			$priorities = Priority::whereIn('name', $inputData['prio'])->get(array('id'))->toArray();

			foreach($priorities as $priority)
			{
				array_push($addPriorities, $priority['id']);
			}

			$company->priorities()->sync($addPriorities);
		}
		
		if(isset($inputData['topic']))
		{
			$addTopics = array();

			$topics = Topic::whereIn('name', $inputData['topic'])->get(array('id'))->toArray();

			foreach($topics as $topic)
			{
				array_push($addTopics, $topic['id']);
			}

			$company->topics()->sync($addTopics);
		}
		
		$company->save();
		
		return Redirect::action('CompanyController@show', $id);

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