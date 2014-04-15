@extends('layouts.master')
 
@section('filter')
@stop
 
@section('content')
	{{	Form::open(array('action' => array('CompanyController@store'))); }}
	<div class="jumbotron">
		<h2><input type="text" class="form-control input-lg" name="name" placeholder="Name"></h2>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h4>Anschrift</h4>
				<p>
					<div class="form-group ">
						<input type="text" class="form-control" name="street" placeholder="Straße">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4" style="padding-right:0px;">
								<input type="text" class="form-control" name="zip" placeholder="PLZ">
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control" name="place" placeholder="Stadt/Ort">
							</div>
						</div>
					</div>
				</p>
				<h4>Kontakt</h4>
				<p>
					<div class="form-group ">
						<input type="text" class="form-control" name="url" placeholder="Website">
					</div>
					<div class="form-group ">
						<input type="text" class="form-control" name="email" placeholder="E-Mail">
					</div>
				</p>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Schwerpunkte</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12" style="overflow:scroll; height:100%;">
								<?php
									foreach($availablePriorities as $availablePriority)
									{
										echo '<div class="checkbox">';
										echo '<label>';
										echo Form::checkbox('prio[]', $availablePriority->name , false);
										echo $availablePriority->name . '</label>';
										echo '</div>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Themen</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12" style="overflow:scroll; height:100%;">
								<?php
									foreach($availableTopics as $availableTopic)
									{
										echo '<div class="checkbox">';
										echo '<label>';
										echo Form::checkbox('topic[]', $availablePriority->name , false);
										echo $availableTopic->name . '</label>';
										echo '</div>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<hr>
				<div class="pull-right">
					<p>
						<a href="{{Request::header('referer')}}" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück</a>
						<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span></button>
					</p>
				</div>
			</div>
			{{	Form::close(); }}
		</div></br>
		</div>
	</div>
@stop