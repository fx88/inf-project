<?php

class CompanyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$availablePriorities = Priority::orderBy('name', 'asc')->get();
		$data['availablePriorities'] = $availablePriorities;
		
		$availableTopics = Topic::orderBy('name', 'asc')->get();
		$data['availableTopics'] = $availableTopics;
		
		$filterPriorities = Input::get('prio');
		$filterPriorities = ($filterPriorities && !is_array($filterPriorities)) ? explode(',', $filterPriorities) : $filterPriorities;
		$data['filter']['prio'] = $filterPriorities;
		
		$filterTopics = Input::get('topic');
		$filterTopics = ($filterTopics && !is_array($filterTopics)) ? explode(',', $filterTopics) : $filterTopics;
		$data['filter']['topic'] = $filterTopics;
		

		$filterRating = Input::get('rate');
		$data['filter']['rate'] = $filterRating;
		
		$filterLetter = Input::get('letter');
		$data['filter']['letter'] = $filterLetter;

		$query = Company::with(array('topics','priorities','ratings'));

		
		if($filterLetter)
		{
			$query->where('name', 'LIKE', $filterLetter .'%');
		}

		if($filterTopics)
		{
			$query->whereHas('topics', function($q) use ($filterTopics)
			{
				foreach($filterTopics as $topic)
				{
					$q->where('name', $topic);
				}
			});
		}
		
		if($filterPriorities)
		{
			$query->whereHas('priorities', function($q) use ($filterPriorities)
			{
				foreach($filterPriorities as $priority)
				{
					$q->where('name', $priority);
				}
			});
		}

		if($filterRating)
		{
			$query->where('rt_avg','>=',$filterRating);
		}

		$data['companies'] = $query->orderBy('name', 'asc')->paginate(10);
		
		return View::make('company.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$availablePriorities = Priority::orderBy('name', 'asc')->get();
		$data['availablePriorities'] = $availablePriorities;
		
		$availableTopics = Topic::orderBy('name', 'asc')->get();
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

		$company->rt_count 	= $company->ratings->count();
		$company->rt_avg 	= $company->ratings->sum('rating') / $company->ratings->count();

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

		$company = Company::find($id);
		
		if($company)
		{
			$rating = Rating::create($inputData);
			
			$company->rt_count 	= $company->ratings->count();
			$company->rt_avg 	= $company->ratings->sum('rating') / $company->ratings->count();
	
			$company->save();

		}
		
		return Redirect::action('CompanyController@show', $id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function destroyRate($id, $rateId)
	{
		$company = Company::find($id);
	
		if($company)
		{
			$rating = Rating::where('company_id' , $id)->where('id' , $rateId)->first();;
			
			if($rating)
			{
				$rating->delete();
			}
			
			$company->rt_count 	= $company->ratings->count();
			$company->rt_avg 	= $company->ratings->sum('rating') / $company->ratings->count();
	
			$company->save();

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
		$availablePriorities = Priority::orderBy('name', 'asc')->get();
		$data['availablePriorities'] = $availablePriorities;
		
		$availableTopics = Topic::orderBy('name', 'asc')->get();
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
		$company->url = (isset($inputData['url'])) ? $inputData['url'] : $company->url;
		
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
		
		$company->rt_count 	= $company->ratings->count();
		$company->rt_avg 	= $company->ratings->sum('rating') / $company->ratings->count();
		
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
		$company = Company::find($id);
		$company->priorities()->sync(array());
		$company->topics()->sync(array());
		$ratings = $company->ratings()->get();

		foreach($ratings as $rating)
		{
			$rating->delete();
		}
		
		$company->delete();

		return Redirect::action('CompanyController@index');
	}
}	