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
			<div class="col-md-3"></div>
			<div class="col-md-6">
				{{ Form::open(array('action'=> 'UserController@login'))}}
					<p>
						<div class="form-group">
							{{ Form::text('email', '' , array('class' => 'form-control' , 'placeholder' => 'Email...')) }}
						</div>
					</p>
					<p>
						<div class="form-group">
							{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password...')) }}
						</div>
					</p>
					<div class="text-right">
						{{ Form::submit('Login' , array('class' => 'btn btn-primary btn-lg' , 'type' => 'submit')) }}
					</div>
				{{ Form::close() }}
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
@stop