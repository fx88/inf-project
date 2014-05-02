@extends('layouts.master')

@section('content')
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-10">
				<h2><?php echo $company->name ?></h2>
			</div>
			<div class="col-md-2">
					<p class="pull-right" style="margin-top:20px; margin-bottom:0px;">
						<a href="{{action('CompanyController@index')}}" type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
						@if(Auth::check())
							<a href="{{action('CompanyController@edit', $company->id)}}" type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon glyphicon-cog"></span></a>
						@endif
					</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<h4>Anschrift</h4>
				<p>
					<?php echo $company->street ?><br />
					<?php echo $company->zip." ".$company->place ?>
				</p>
				<h4>Kontakt</h4>
				<p>
					Website: <a href="http://<?php echo $company->url ?>"><?php echo $company->url ?></a><br />
					E-Mail: <a href="mailto:<?php echo $company->email ?>"><?php echo $company->email ?></a>
				</p>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Schwerpunkte</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<?php
									foreach($company->priorities as $priority)
									{
										echo '<span class="label label-default">' . $priority->name . '</span></br>';
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
							<div class="col-md-12">
								<?php
									foreach($company->topics as $topic)
									{
										echo '<span class="label label-default">' . $topic->name . '</span></br>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
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
								<div class="row">
									<div class="col-md-12">
										Anzahl der Bewertungen:
									</div>
									<div class="col-md-12 text-center">
											<h2 style="margin-top:5px;"> {{ $company->ratings->count() }} </h2>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										Durchnittliche Bewertung:
									</div>
									<div class="col-md-12 text-center">
										<h2 style="margin-top:10spx;">
											<?php
												if($company->ratings->count() > 0)
												{
													$avg = $company->ratings->sum('rating') / $company->ratings->count();													
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
												echo '<br><small> (' . round($avg,2) . ')</small>';
											?>
										</h2>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<h3 class="panel-title">Neue Bewertung abgeben...</h3></br>
								{{	Form::open(array('action' => array('CompanyController@storeRate', $company->id))); }}
								<div class="form-group" style="margin-bottom:0px;">
									<label for="inputRate" class="control-label">Bewertung</label>
									<div class="pull-right" style="text-align:right;">
										<div id="inputRate" class="btn-group btn-group-sm" data-toggle="buttons">
											<label class="btn btn-success active">
												<input checked="checked" type="radio" name="rating" id="1" value="1">1
											</label>
											<label class="btn btn-success">
												<input type="radio" name="rating" id="2" value="2">2
											</label>
											<label class="btn btn-success">
												<input type="radio" name="rating" id="3" value="3">3
											</label>
											<label class="btn btn-success">
												<input type="radio" name="rating" id="4" value="4">4
											</label>
											<label class="btn btn-success">
												<input type="radio" name="rating" id="5" value="5">5
											</label>
										</div>
									</div>
									<div style="height:20px;"></div>
									<textarea name="comment" class="form-control" rows="2" maxlength="50" placeholder="Lass alles raus!"></textarea>
									<div class="pull-right" style="margin-top:4px;">
										{{ Form::submit('Absenden' , array('class' => 'btn btn-primary btn-xs' , 'type' => 'submit')) }}		
									</div>
									<span class="help-block" style="margin-bottom:0px;">Hinweis: maximal 50 Zeichen.</span>
								</div>
								{{	Form::close(); }}
							</div>
						</div></br>
					</div>
					<table class="table table-striped" style="margin-bottom:0px;">
							<tr>
								<th style="background-color:#428bca;color:white;">Einzelbewertungen</th>
								<th style="background-color:#428bca;color:white;"></th>
							</tr>
							@foreach ($company->ratings as $rating)
								<tr>
									<td>
										{{ $rating->comment }}
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
								</tr>
		    				@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
@stop