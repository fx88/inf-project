@extends('layouts.master')
 
@section('filter')
	<a href="{{action('CompanyController@index')}}" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück...</a>
@stop
 
@section('content')
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-10">
				<h2>Login</h2>
			</div>
			<div class="col-md-2">

			</div>
		</div>
		<hr>
		<div class="row">
			{{ Form::open(array('action'=> 'UserController@login'))}}
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<p>
					<div class="form-group ">
						<input type="email" class="form-control" name="email" placeholder="Email">
					</div>
				</p>
				<p>
					<div class="form-group ">
						<input type="password" class="form-control" name="password" placeholder="Kennwort">
					</div>
				</p>
				<div class="pull-right">
					<p>
						<a href="" type="submit" class="btn btn-success btn-lg">Login</a>
					</p>
				</div>
			</div>
			<div class="col-md-3"></div>
			{{ Form::close() }}
		</div>
	</div>
@stop