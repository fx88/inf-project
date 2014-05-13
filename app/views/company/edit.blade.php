@extends('layouts.master')
 
@section('content')
	{{	Form::open(array('action' => array('CompanyController@update', $company->id))); }}
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-9">
				<h2><input type="text" class="form-control input-lg" name="name" placeholder="Name" value="<?php echo $company->name ?>"></h2>
			</div>
			<div class="col-md-3">
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{action('CompanyController@show', $company->id)}}" type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
						<a href="{{Request::header('referer')}}" type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
						<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span></button>
					</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-4">
				<h4>Anschrift</h4>
				<p>
					<div class="form-group ">
						<input type="text" class="form-control" name="street" placeholder="Straße" value="<?php echo $company->street ?>">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4" style="padding-right:0px;">
								<input type="text" class="form-control" name="zip" placeholder="PLZ" value="<?php echo $company->zip ?>">
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control" name="place" placeholder="Stadt/Ort" value="<?php echo $company->place ?>">
							</div>
						</div>
					</div>
				</p>
				<h4>Kontakt</h4>
				<p>
					<div class="form-group ">
						<input type="text" class="form-control" name="url" placeholder="Website" value="<?php echo $company->url ?>">
					</div>
					<div class="form-group ">
						<input type="text" class="form-control" name="email" placeholder="E-Mail" value="<?php echo $company->email ?>">
					</div>
				</p>
			</div>
			
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Studienschwerpunkte</h4>
					</div>
					<div class="panel-body"  style="overflow-x: hidden; overflow-y: auto; max-height:250px;">
						<div class="form-group">
							<div data-toggle="buttons">
								<?php
									foreach($availablePriorities as $availablePriority)
									{
										
										echo '<label class="btn btn-default btn-xs btn-block';
										echo ($company->priorities->contains($availablePriority->id)) ? ' active' : ''; 
										echo '">' . Form::checkbox('prio[]', $availablePriority->name , $company->priorities->contains($availablePriority->id));
										echo $availablePriority->name;
										echo '</label>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Themen</h4>
					</div>
					<div class="panel-body"  style="overflow-x: hidden; overflow-y: auto; max-height:250px;">
						<div class="form-group">
							<div data-toggle="buttons">
								<?php
									foreach($availableTopics as $availableTopic)
									{
										
										echo '<label class="btn btn-default btn-xs btn-block';
										echo ($company->topics->contains($availableTopic->id)) ? ' active' : ''; 
										echo '">' . Form::checkbox('prio[]', $availableTopic->name , $company->topics->contains($availableTopic->id));
										echo $availableTopic->name;
										echo '</label>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
		</div>
		{{	Form::close(); }}
		</div></br>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Bewertungsübersicht</h3>
					</div>
					<div class="panel-body" style="height:100%;">
						<div class="row">
							<div class="col-md-6">
								Anzahl der Bewertungen: <strong> {{ $company->rt_count }} </strong>
							</div>
							<div class="col-md-6">
								Durchschnittliche Bewertung: 
									<?php
										if($company->ratings->count() > 0)
										{
											$avg = $company->rt_avg;
										}
										else
										{
											$avg = 0;
										}
										
										for($i = 1; $i <= round($avg); $i++)
										{
											echo '<span class="glyphicon glyphicon-star"></span>';
										}
										for ($i = 1; $i <= 5-round($avg); $i++)
										{
											echo '<span class="glyphicon glyphicon-star-empty"></span>';
										}
										echo '<strong> (' . round($avg,2) . ')</strong>';
									?>
							</div>
						</div>
					</div>
						<table class="table" style="margin-bottom:0px;">
							@foreach ($company->ratings as $rating)
								<tr>
									<td>
										{{ $rating->comment }};
									</td>
									<td style="text-align:right;">
										<?php
											for($i = 1; $i <= $rating->rating; $i++)
											{
												echo '<span class="glyphicon glyphicon-star"></span>';
											}
											for ($i = 1; $i <= 5-$rating->rating; $i++)
											{
												echo '<span class="glyphicon glyphicon-star-empty"></span>';
											}
											echo ' (' . $rating->rating . ')';
										?>
									</td>
									<td class="text-right">
										<a href="{{action('CompanyController@destroyRate', array($company->id, $rating->id));}}"type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
		    				@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>

@stop