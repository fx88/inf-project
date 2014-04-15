@extends('layouts.master')
 
@section('filter')
<a href="{{Request::header('referer')}}" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück...</a>
@stop
 
@section('content')

	<div class="jumbotron">
		{{	Form::open(array('action' => array('UserController@store') , 'role' => 'form')) }}
		<div class="row">
			<div class="col-md-9">
				<h2><input type="text" class="form-control input-lg" name="name" placeholder="Benutzername"></h2>
			</div>
			<div class="col-md-3">
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{Request::header('referer')}}" type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
						<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span></button>
					</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h4>Email:</h4>
				<p>
					<div class="form-group ">
						<input type="text" class="form-control" name="email" placeholder="Email">
					</div>
				</p>
				<h4>Beschreibung:</h4>
				<p>
					<div class="form-group ">
						<textarea type="text" class="form-control" name="description" rows="1" placeholder="Beschreibung"></textarea>
					</div>
				</p>
			</div>
			<div class="col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h4 class="panel-title">Kennwort:</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12" style="overflow:scroll; height:100%;">
								<div class="form-group ">
									<input type="password" class="form-control" name="password" placeholder="Kennwort">
								</div>
								<div class="form-group ">
									<input type="password" class="form-control" name="password_confirmation" placeholder="Kennwort wdh.">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
		</div>
		{{	Form::close(); }}
	</div>
@stop