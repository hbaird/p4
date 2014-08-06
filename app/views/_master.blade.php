<!doctype html>
<html>
<head>


	<title>@yield('title','Crocodilians')</title>


	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles/crocs.css" type="text/css">


	@yield('head')


</head>


<body class="container">

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	@if(Auth::check())
		<div class="crud">
		<a href='/logout'>Log out {{ Auth::user()->email; }}</a><br>
		<a href='/croc/create'>Add a Croc</a><br>
		<a href='/croc/edit'>Edit a Croc</a><br>
		CRUD functions: Deletion Pending!<br>
		<a href='/croc/edit'>Create</a>   
		<a href='/croc/edit'>Read</a>   
		<a href='/croc/edit'>Update</a>   
		<a href='/croc/edit'>Delete</a>
		</div>

	@else 
		<a href='/signup'>Sign up</a> or <a href='/login'>Log in</a>
	@endif

	<br>

	<a href='/'>Home</a><br>
	<a href='/add'>Add a Croc</a><br>

	<br>

	@yield('content')


	@yield('body')


</body>


</html>
