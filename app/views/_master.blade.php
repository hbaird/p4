<!doctype html>
<html>
<head>


	<title>@yield('title','Crocodilians')</title>


	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles/crocs.css" type="text/css">


	@yield('head')


</head>


<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif


	<a href='/'><img class='logo' src='<?php echo URL::asset(''); ?>' alt='All About Crocs Logo'></a>


	@if(Auth::check())
		<a href='/logout'>Log out {{ Auth::user()->email; }}</a><br><br>
	@else 
		<a href='/signup'>Sign up</a> or <a href='/login'>Log in</a>
	@endif

	<br>

	<a href='/add'>Add a Croc</a>

	<br>

	@yield('content')


	@yield('body')


</body>


</html>
