@extends('layouts.master')
 
@section('filter')
	
@stop
 
@section('content')
		@if(isset($delete) && $delete)
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Super!</strong> Der Benutzer wurde gelöscht
			</div>
		@elseif(isset($delete) && !$delete)
			<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Warning!</strong> Du kannst diesen Benutzer nicht löschen, da du es selbst bist!
			</div>
		@endif
		<h2>Benutzer - Übersicht</h2>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>
								<a href="{{ action('UserController@show', $user->id)}}"> {{ $user->name }}</a>
							</td>
							<td style="text-align:right;">
								<a href="{{ action('UserController@edit', $user->id)}}" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="{{ action('UserController@destroy', $user->id)}}" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@stop