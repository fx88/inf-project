<!DOCTYPE html>
<html lang="de">
<head>
	<title>Firmendatenbank - Hochschule Ravensburg-Weingarten</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Ferdinand Armbruster - 21172">
	<meta name="description" content="Firmendatenbank der Hochschule Ravensburg-Weingarten." />
	<meta name="keywords" content="firmen,datenbank,praktikum" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('style/style.css') }}" media="screen" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="{{ URL::asset('js/toggles.min.js') }}"></script>
</head>
<body>
<div clas="row" style="height:100%;">
	<div class="col-md-2 hidden-xs"></div>
	<div class="col-md-8 bg-shadow">
		<div class="row">
			<div class="col-md-5">
				<img src="{{ URL::asset('img/logo_hs_wgt.gif') }}" alt="Tanzmaus">
			</div>
			<div class="col-md-7" style="text-align:right;">
				<h3>Firmendatenbank</h3>
				<h4><small>Ansprechpartner: Prof. Keller (Praxisamt)</small></h4>
			</div>
		</div>
		<div class="nav-line"></div>
		<div class="row">
			<div class="col-md-11" style="padding:2px;">
			<ul class="nav nav-pills">
				@if(!Auth::check())
					<li class="col-md-3 text-center" style="padding:0px;">
						<a href="{{ action('CompanyController@index')}}">Unternehmensübersicht</a>
					</li>
				@else
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Unternehmen<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li role="presentation"><a href="{{ action('CompanyController@index')}}" role="menuitem" tabindex="-1">Übersicht</a></li>
								<li role="presentation" class="divider"></li>
								<li role="presentation"><a href="{{ action('CompanyController@create')}}" role="menuitem" tabindex="-1">Neue Firma erstellen</a></li>
							</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Schwerpunkte<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li role="presentation"><a href="{{ action('PriorityController@index')}}" role="menuitem" tabindex="-1">Übersicht</a></li>
								<li role="presentation" class="divider"></li>
								<li role="presentation"><a href="{{ action('PriorityController@create')}}" role="menuitem" tabindex="-1">Neuen Schwerpunkt erstellen</a></li>
							</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategorien<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li role="presentation"><a href="{{ action('TopicController@index')}}" role="menuitem" tabindex="-1">Übersicht</a></li>
								<li role="presentation" class="divider"></li>
								<li role="presentation"><a href="{{ action('TopicController@create')}}" role="menuitem" tabindex="-1">Neue Kategorie erstellen</a></li>
							</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Benutzerverwaltung<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li role="presentation"><a href="{{ action('UserController@index')}}" role="menuitem" tabindex="-1">Übersicht</a></li>
								<li role="presentation" class="divider"></li>
								<li role="presentation"><a href="{{ action('UserController@create')}}" role="menuitem" tabindex="-1">Neuen Benutzer erstellen</a></li>
							</ul>
					</li>
				@endif
			</ul>
			</div>
			<div class="col-md-1" style="padding:2px;">
			<ul class="nav nav-pills pull-right">
				<li class="dropdown" style="min-width:25px;">
					<a class="dropdown-toggle" data-toggle="dropdown" style="text-align:right;" href="#"><span class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
					@if (Auth::check())
							<li role="presentation" class="dropdown-header">{{ Auth::user()->name }}</li>
							<li><a href="{{ action('UserController@edit', Auth::user()->id)}}" class="btn" data-method="post">Edit Profile</a></li>
							<li role="presentation" class="divider"></li>
							<li><a href="{{ action('UserController@logout')}}" class="btn" data-method="post">Logout</a></li>
					    </ul>
					@else
							<li role="presentation" class="dropdown-header">Login</li>
							<li role="presentation" class="divider" style="margin: 5px 0px;"></li>
							<li>
								{{ Form::open(array('action'=> 'UserController@login'))}}
									<div class="form-group" style="margin-bottom:10px;">
										{{ Form::text('email', '' , array('class' => 'form-control input-sm' , 'placeholder' => 'Email...')) }}
									</div>
									<div class="form-group" style="margin-bottom:10px;">
										{{ Form::password('password', array('class' => 'form-control input-sm', 'placeholder' => 'Password...')) }}
									</div>
								<div class="text-right">
									{{ Form::submit('Login' , array('class' => 'btn btn-primary btn-xs' , 'type' => 'submit')) }}
								</div>
								{{ Form::close() }}
							</li>
					    </ul>
			    	@endif
				</li>
			</ul>

			</div>
		</div>
		<div class="nav-line"></div>
		<div style="height:24px;"></div>
		<div class="row">
			<div class="col-md-12">
				@section('content')
					section.content
				@show
			</div>
		</div>
	</div>
	<div class="col-md-2 hidden-xs"></div>
</div>
</html>

