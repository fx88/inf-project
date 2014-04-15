@extends('layouts.master')
 
@section('filter')
<a href="{{Request::header('referer')}}" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück...</a>
@stop
 
@section('content')
		<div class="jumbotron">
		<div class="row">
			<div class="col-md-9">
				<h2><input type="text" class="form-control input-lg" name="name" placeholder="Name" value="<?php echo $user->name ?>"></h2>
			</div>
			<div class="col-md-3">
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{Request::header('referer')}}" type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
						<a href="" type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span></a>
					</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h4>Email:</h4>
				<p>
					<div class="form-group ">
						<input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $user->email ?>">
					</div>
				</p>
				<h4>Beschreibung:</h4>
				<p>
					<div class="form-group ">
						<textarea type="text" class="form-control" name="description" rows="2" placeholder="Beschreibung" value="<?php echo $user->description ?>"></textarea>
					</div>
				</p>
			</div>
			<div class="col-md-6">
				<div class="panel panel-danger" style="height:100%;">
					<div class="panel-heading">
						<h4 class="panel-title">Kennwort:</h4>
					</div>
					<div class="panel-body" style="height:100%;">
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