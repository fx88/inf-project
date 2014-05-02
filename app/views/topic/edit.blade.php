@extends('layouts.master')
 
@section('filter')
<a href="{{Request::header('referer')}}" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück...</a>
@stop
 
@section('content')

	<div class="jumbotron">
		{{	Form::open(array('action' => array('TopicController@update', $topic->id))) }}
		<div class="row">
			<div class="col-md-9">
				<h2><input type="text" class="form-control input-lg" name="name" placeholder="Name" value="<?php echo $topic->name ?>"></h2>
			</div>
			<div class="col-md-3">
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{action('TopicController@index')}}" type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
						<a href="{{ action('TopicController@destroy',$topic->id)}}" type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
						<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span></button>
					</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Firmen</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" style="overflow:scroll; max-height:400px;">
						<table class="table" style="margin-bottom:0px;">
							@foreach ($availableCompanies as $availableCompany)
								<tr>
									<td>
										<div class="checkbox">
											<label>
												{{ Form::checkbox('company[]', $availableCompany->name , $topic->companies->contains($availableCompany->id)) }}
											{{ $availableCompany->name }}</label>
										</div>
									</td>
								</tr>
		    				@endforeach
						</table>
					</div>
				</div>
				</div>
			<div>
		</div>
	{{	Form::close(); }}
	</div>
		</div>
	</div>
@stop