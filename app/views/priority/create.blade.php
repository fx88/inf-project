@extends('layouts.master')
 
@section('filter')
<a href="{{Request::header('referer')}}" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück...</a>
@stop
 
@section('content')
	<div class="jumbotron">
		{{	Form::open(array('action' => array('PriorityController@store') , 'role' => 'form')) }}
		<div class="row">
			<div class="col-md-9">
				<h2><input type="text" class="form-control input-lg" name="name" placeholder="Schwerpunktname"></h2>
			</div>
			<div class="col-md-3">
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
												<a href="{{action('PriorityController@index')}}" type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
						<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span></button>
					</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h4>Abkürzung:</h4>
				<p>
					<div class="form-group ">
						<input type="text" class="form-control" name="short" placeholder="Abkürzung...">
					</div>
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
					<div id="collapseOne" class="panel-collapse collapse in" style="overflow:scroll; max-height:300px;">
						<table class="table" style="margin-bottom:0px;">
							@foreach ($availableCompanies as $availableCompany)
								<tr>
									<td>
										<div class="checkbox">
											<label>
												{{ Form::checkbox('company[]', $availableCompany->name , false) }}
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