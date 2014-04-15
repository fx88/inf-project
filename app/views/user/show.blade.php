@extends('layouts.master')
 
@section('filter')
<a href="{{Request::header('referer')}}" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück...</a>
@stop
 
@section('content')

	<div class="jumbotron">
		<div class="row">
			<div class="col-md-10">
				<h2><?php echo $user->name ?></h2>
			</div>
			<div class="col-md-2">
				@if(Auth::check())
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{action('UserController@edit', $user->id)}}" type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon glyphicon-cog"></span></a>
					</p>
				@endif
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h4>Name:</h4>
				<p>
					{{ $user->name }}
				</p>
				<h4>Email:</h4>
				<p>
					{{ $user->email }}
				</p>
				<h4>Beschreibung:</h4>
				<p>
					{{ $user->description }}
				</p>
			</div>
		</div>


	</div>


	
@stop