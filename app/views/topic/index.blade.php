@extends('layouts.master')
 
@section('filter')
	
@stop
 
@section('content')

		<h2>Kategorien - Übersicht</h2>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($topics as $topic)
						<tr>
							<td>
								<a href="{{ action('TopicController@show', $topic->id)}}"> {{ $topic->name }}</a>
							</td>
							<td style="text-align:right;">
								<a href="{{ action('TopicController@edit', $topic->id)}}" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="{{ action('TopicController@destroy', $topic->id)}}" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@stop