@extends('layouts.master')

@section('filter')
	{{ Form::open(array('action' => 'CompanyController@index', 'method'=>'GET')) }}
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Studienschwerpunkte</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="form-group">
					<?php
						foreach($availablePriorities as $availablePriority)
						{	
							echo '<div class="checkbox">';
							echo '<label>';
							echo Form::checkbox('prio[]', $availablePriority->name , ($filterPriorities) ? in_array($availablePriority->name,$filterPriorities) : false);
							echo $availablePriority->name;
							echo '</label>';
							echo '</div>';
						}
					?>
				</div>
			</div>
		</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Bewertung</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<?php

							for($i=4; $i >= 0; $i--)
							{
								echo '<li><a href="url">';
								for($j=0; $j <= $i; $j++)
								{
									echo '<span class="glyphicon glyphicon-star"></span>';
								}
								
								for($j=1; $j <= 4-$i; $j++)
								{
									echo '<span class="glyphicon glyphicon-star-empty"></span>';
								}
								echo ' (+)</a></li>';
							}
							/*
								// Filter für Bewertungsdurchschnitt.
								$url = "index.php?";
								$class = "active";
								
								echo "<li class=\"$class\"><a href=\"$url\">";
								for($k=1; $k<=5; $k++)
								{
									if($k <= $i)
									{
										echo '<img src="./img/star.png" alt="*" />';
									}
									else
									{
										echo '<img src="./img/star_bw.png" alt="" />';
									}
								}
								echo "  & mehr</a></li>";
							}
*/
						?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Themengebiete</a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="form-group">
						<?php
							foreach($availableTopics as $availableTopic)
							{	
								echo '<div class="checkbox">';
								echo '<label>';
								echo Form::checkbox('topic[]', $availableTopic->name , ($filterTopics) ? in_array($availableTopic->name,$filterTopics) : false);
								echo $availableTopic->name;
								echo '</label>';
								echo '</div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pull-right">
		<a class="btn btn-warning btn-xs" href="{{ action('CompanyController@index', null) }}"><span class="glyphicon glyphicon-repeat"></span></a>
		{{ Form::submit('Filter anwenden...' , array('class' => 'btn btn-success btn-xs' , 'type' => 'submit')) }}
	</div>
	{{ Form::close() }}
@stop

@section('content')
		<h2>Firmen - Übersicht</h2>
		<div style="text-align:center;">
			<ul class="pagination pagination-sm">

				<?php
					echo '<li><a href="#">Alle</a></li>';
					
					$regexs = array(
						'0-9'=>'0-9', 'A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 
						'E'=>'E', 'F'=>'F', 'G'=>'G', 'H'=>'H', 'I'=>'I',
						'J'=>'J', 'K'=>'K', 'L'=>'L', 'M'=>'M', 'N'=>'N', 
						'O'=>'O', 'P'=>'P', 'Q'=>'Q', 'R'=>'R', 'S'=>'S', 
						'T'=>'T', 'U'=>'U', 'V'=>'V', 'W'=>'W', 'X'=>'X', 
						'Y'=>'Y', 'Z'=>'Z'
					);
				
					foreach($regexs as $name=>$regex)
					{
						echo '<li><a href="#">'. $regex . '</a></li>';
						//echo "<a href=\"company?page=$regex\" class=\"111\">$name</a> ";
					}
				?>
			</ul>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
					<th>Name</td>
					<th>Ort</td>
					<th>Schwerpunkte</td>
					<th>Bewertung</td>
					<?php
						if(Auth::check())
						{
							echo '<th></th>';
						};
					?>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($companies as $company)
					{
						echo '<tr>';
						echo '<td><a href=\\company\\' . $company->id . '>' . $company->name . '</a></td>';
						echo '<td>' . $company->place . '</td>';
						echo '<td></td>';

						echo '<td>';

							for ($i = 1; $i <= round($company->ratings()->avg('rating')); $i++) {
							    echo '<span class="glyphicon glyphicon-star"></span>';
							}
							for ($i = 1; $i <= 5-round($company->ratings()->avg('rating')); $i++) {
							    echo '<span class="glyphicon glyphicon-star-empty"></span>';
							}
							echo ' (' . round($company->ratings()->avg('rating'),1) . ')';
						echo '</td>';
						
						if(Auth::check())
						{
							echo '<td><a href="' . action('CompanyController@edit', $company->id) . '" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a> ';
							echo '<a href="' . action('CompanyController@destroy', $company->id) . '" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
						};
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
@stop