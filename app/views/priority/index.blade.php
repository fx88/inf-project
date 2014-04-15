@extends('layouts.master')
 
@section('filter')
	
@stop
 
@section('content')
		<h2>Schwerpunkte - Übersicht</h2>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th class="text-center">Abkürzung</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($priorities as $priority)
						<tr>
							<td>
								<a href="{{ action('PriorityController@show', $priority->id)}}"> {{ $priority->name }}</a>
							</td>
							<td class="text-center">
								{{ $priority->short }}
							</td>
							<td style="text-align:right;">
								<a href="{{ action('PriorityController@edit', $priority->id)}}" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="{{ action('PriorityController@destroy', $priority->id)}}" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@stop