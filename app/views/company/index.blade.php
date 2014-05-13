@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-3">
		{{ Form::open(array('action' => 'CompanyController@index', 'method'=>'GET')) }}
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Studienschwerpunkte</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
				<div class="panel-body"style="overflow-y: scroll; max-height:250px;">
					<div class="form-group">
						<div data-toggle="buttons">
							<?php
								foreach($availablePriorities as $availablePriority)
								{
									
									echo '<label class="btn btn-default btn-xs btn-block';
									echo (isset($filter['prio'])) ? ((in_array($availablePriority->name,$filter['prio'])) ? ' active' : '') : ''; 
									echo '">' . Form::checkbox('prio[]', $availablePriority->name , ($filter['prio']) ? in_array($availablePriority->name,$filter['prio']) : false);
									echo $availablePriority->name;
									echo '</label>';
								}
							?>
						</div>
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
						<div data-toggle="buttons">
							<?php
	
								for($i=4; $i >= 0; $i--)
								{
									echo '<label class="btn btn-default btn-xs btn-block';
									echo (isset($filter['rate'])) ? (($filter['rate'] == ($i+1)) ? ' active' : '') : '';
									echo '"><input type="radio" name="rate" value="' . ($i + 1) . '">';
									for($j=0; $j <= $i; $j++)
									{
										echo '<span class="glyphicon glyphicon-star"></span>';
									}
									
									for($j=1; $j <= 4-$i; $j++)
									{
										echo '<span class="glyphicon glyphicon-star-empty"></span>';
									}
									echo ' (+)</label>';
								}
							?>
						</div>
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
					<div class="panel-body"style="overflow-y: scroll; max-height:250px;">
						<div data-toggle="buttons">
							<?php
								foreach($availableTopics as $availableTopic)
								{
									
									echo '<label class="btn btn-default btn-xs btn-block';
									echo (isset($filter['topic'])) ? ((in_array($availableTopic->name,$filter['topic'])) ? ' active' : '') : ''; 
									echo '">' . Form::checkbox('topic[]', $availableTopic->name , ($filter['topic']) ? in_array($availableTopic->name,$filter['topic']) : false);
									echo $availableTopic->name;
									echo '</label>';
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
	</div>
	<div class="col-md-9">
		<h2>Firmen - Übersicht</h2>
		<div style="text-align:center;">
			<ul class="pagination pagination-sm">

				<?php
					echo '<li';
					echo (isset($filter['letter'])) ? '' : ' class="active"';
					echo '>' . link_to_action('CompanyController@index', 'Alle', array_merge($filter,array('letter' => ''))) . '</li>';
					
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
						echo '<li';
						echo (isset($filter['letter'])) ? (($filter['letter'] == $regex) ? ' class="active"' : '') : '';
						echo '>'. link_to_action('CompanyController@index', $regex, array_merge($filter, array('letter' => $regex))) . '</li>';
					
						//echo '<li><a href="#">'. $regex . '</a></li>';
						//echo "<a href=\"company?page=$regex\" class=\"111\">$name</a> ";
					}
				?>
			</ul>
		</div>
		@if(count($companies) == 0)
			<div class="well text-center">
				<h5>Keine Firmen gefunden...</h5>
			</div>
		@else
			<div class="table-responsive">
	
				<table class="table table-striped table-hover table-condensed">
					<thead>
						<tr>
							@if(Auth::check())
								<th class="col-md-6">Name</td>
								<th class="col-md-2">Ort</td>
								<th class="col-md-2">Bewertung</td>	
								<th class="col-md-2"></th>
							@else
								<th class="col-md-6">Name</td>
								<th class="col-md-4">Ort</td>
								<th class="col-md-2">Bewertung</td>	
							@endif
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($companies as $company)
						{
							echo '<tr>';
							echo '<td><a href=\\company\\' . $company->id . '>' . $company->name . '</a></td>';
							echo '<td>' . $company->place . '</td>';
							echo '<td>';
								for ($i = 1; $i <= round($company->rt_avg); $i++) {
								    echo '<span class="glyphicon glyphicon-star"></span>';
								}
								for ($i = 1; $i <= 5-round($company->rt_avg); $i++) {
								    echo '<span class="glyphicon glyphicon-star-empty"></span>';
								}
								echo ' (' . round($company->rt_avg,1) . ')';
							echo '</td>';
							
							if(Auth::check())
							{
								echo '<td><a  href="' . action('CompanyController@edit', $company->id) . '" type="button" class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-pencil"></span></a> ';
								echo '<a href="' . action('CompanyController@destroy', $company->id) . '" type="button" class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
							};
							echo '</tr>';
						}
					?>
					</tbody>
				</table>
				<div style="text-align:center;">
					{{ $companies->appends(Request::except('page'))->links() }}
				</div>
			</div>
		@endif
	</div>
</div>
@stop
