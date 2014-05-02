@extends('layouts.master')

@section('content')
	{{	Form::open(array('action' => array('CompanyController@store'))); }}
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-9">
				<h2><input type="text" class="form-control input-lg" name="name" placeholder="Name"></h2>
			</div>
			<div class="col-md-3">
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{action('CompanyController@index')}}" type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
						<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span></button>
					</p>
			</div>
		</div>
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
						<h4 class="panel-title">Studienschwerpunkte</h4>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<div data-toggle="buttons">
								<?php
									foreach($availablePriorities as $availablePriority)
									{
										
										echo '<label class="btn btn-default btn-xs btn-block';
										echo '">' . Form::checkbox('prio[]', $availablePriority->name);
										echo $availablePriority->name;
										echo '</label>';
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
						<div class="form-group">
							<div data-toggle="buttons">
								<?php
									foreach($availableTopics as $availableTopic)
									{
										
										echo '<label class="btn btn-default btn-xs btn-block';
										echo '">' . Form::checkbox('prio[]', $availableTopic->name);
										echo $availableTopic->name;
										echo '</label>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{	Form::close(); }}
		</div></br>
		</div>
	</div>
@stop