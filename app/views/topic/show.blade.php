@extends('layouts.master')
 
@section('filter')
<a href="{{Request::header('referer')}}" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-circle-arrow-left"></span> zurück...</a>
@stop
 
@section('content')
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-10">
				<h2><?php echo $topic->name ?></h2>
			</div>
			<div class="col-md-2">
				@if(Auth::check())
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{action('TopicController@edit', $topic->id)}}" type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon glyphicon-cog"></span></a>
					</p>
				@endif
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
					<div id="collapseOne" class="panel-collapse collapse in">
					<table class="table" style="margin-bottom:0px;">
							<?php 
								foreach($topic->companies as $company)
								{
									echo '<tr><td>';
									echo $company->name;
									echo '</td>';
								}
							?>
						</table>
					</div>
				</div>
				</div>
			<div>
		</div>
	</div>
@stop