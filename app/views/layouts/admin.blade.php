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
	<script src="{{ URL::asset('js/jquery-1.5.2.min.js') }}"></script>
	<script src="{{ URL::asset('js/toggles.min.js') }}"></script>
</head>
<body>
<div id="container">
	<div class="row">
		<div class="col-md-9">
			<img src="{{ URL::asset('img/logo_hs_wgt.gif') }}" alt="Tanzmaus">
		</div>
		<div class="col-md-3">
			@if (Auth::check())
	    		Hallo {{ Auth::user()->name }}, du bist angemeldet! <button type="button" class="btn btn-danger">Danger</button><a href="{{ action('UserController@logout')}}" class="btn" data-				method="post">Logout</a>
	    	@else
	        	{{ Form::open(array('action'=> 'UserController@login'))}}
				<div class="form-group">
					{{ Form::text('email', '' , array('class' => 'form-control input-sm' , 'placeholder' => 'Email...')) }}
					{{ Form::password('password', array('class' => 'form-control input-sm', 'placeholder' => 'Password...')) }}
				</div>
				<div class="text-right">
					{{ Form::submit('Login' , array('class' => 'btn btn-primary btn-xs' , 'type' => 'submit')) }}
				</div>
				{{ Form::close() }}
	    	@endif
		</div>
	</div>
	<div class="line"></div>
	<div class="row menu">
		<ul class"nav nav-pills">
			<li>Firmen</li>
			<li>Schwerpunkte</li>
		</ul>
		<div class="col-md-3">Firmen</div>
		<div class="col-md-3">Schwerpunkte</div>
		<div class="col-md-3">Ketegorien</div>
		<div class="col-md-3">Benutzer</div>
	</div>
	<div class="line"></div>

	<div id="filter">
       	@section('filter')
                    This is the master sidebar.
        @show
        
		<div class="main">
			<p class="head">Firmen<span id="toggle_schwerpunkte" class="fl_right"><img src="{{ asset('img/dots_white_left.png') }}" alt="Ein-/Ausblenden" /></span></p>
			<div id="filter_schwerpunkte">
				<ul>
					<li><a href="{{ action('CompanyController@index') }}" class="button">Übersicht</a></li>
					<li><a href="{{ action('CompanyController@create') }}" class="button">Neue Firma anlegen</a></li>
				</ul>
			</div>
		</div>
		<div class="main">
			<p class="head">Schwerpunkte<span id="toggle_rating" class="fl_right"><img src="{{ asset('img/dots_white_left.png') }}" alt="Ein-/Ausblenden" /></span></p>
			<div id="filter_rating">
				<ul>
					<li><a href="{{ action('PriorityController@index') }}" class="button">Übersicht</a></li>
					<li><a href="{{ action('PriorityController@create') }}" class="button">Neuen Schwerpunkt anlegen</a></li>
				</ul>
			</div>
		</div>
		<div class="main">
			<p class="head">Kategorien<span id="toggle_themen" class="fl_right"><img src="{{ asset('img/dots_white_left.png') }}" alt="Ein-/Ausblenden" /></span></p>
			<div id="filter_themen">
				<ul>
					<li><a href="{{ action('TopicController@index') }}" class="button">Übersicht</a></li>
					<li><a href="{{ action('TopicController@create') }}" class="button">Neue Kategorie anlegen</a></li>
				</ul>
			</div>
		</div>
		<div class="main">
			<p class="head">Benutzer<span id="toggle_user" class="fl_right"><img src="{{ asset('img/dots_white_left.png') }}" alt="Ein-/Ausblenden" /></span></p>
			<div id="filter_user">
				<ul>
					<li><a href="{{ action('UserController@index') }}" class="button">Übersicht</a></li>
					<li><a href="{{ action('UserController@create') }}" class="button">Neuen Benutzer anlegen</a></li>
				</ul>
			</div>
		</div>
	</div><!-- FILTER -->
	<div id="content">
		@section('content')
                    This is the master sidebar.
        @show
	</div><!-- CONTENT -->
</div><!-- CONTAINER -->
</body>
</html>

