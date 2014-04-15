@extends('layouts.master')
 
@section('filter')
	<div class="main">
			<p class="head"><a href="{{  Request::header('referer') ;}}">Zurück</a></p>
	</div>
@stop
 
@section('content')
	
	<h1>LOGIN</h1>
	<div>
		<table class="firmendetails">
			<colgroup>
				<col style="width:40%">
				<col style="width:60%">
			</colgroup>
			<tbody>
				<tr>
					<td>
						<h3>Login</h3>
					</td>
				</tr>
			</tbody>
			
			{{ Form::open(array('action'=> 'UserController@login'))}}
			{{ Form::text('email','email') }}
			{{ Form::text('password','password') }}
			{{ Form::submit('Login') }}
			{{ Form::close() }}
		</table>
		<br />
	</div><!-- CONTENT -->
	
	<div id="ratings">
	</div><!-- RATINGS -->
@stop