<!doctype html>
<html>
<head>


	<title>@yield('title','Crocodilians')</title>


	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="styles/crocs.css" type="text/css">


	@yield('head')


</head>

<body class="container">

	<div span="4">
			@if(Session::get('flash_message'))
				<div class='flash-message'>{{ Session::get('flash_message') }}</div>
			@endif

			<div class="nav">
				@if(Auth::check())
			
					<a href='/logout'>Log out {{ Auth::user()->email; }}</a><br>
					<a href='/croc/create'>Add a Croc</a><br>
					<a href='/croc/edit'>Edit a Croc</a><br>
					CRUD functions: Deletion Pending!<br>
					<a href='/crud-create'>Create</a>   
					<a href='/crud-read'>Read</a>   
					<a href='/crud-update'>Update</a>   
					<a href='/crud-delete'>Delete</a>
		

				@else 
				<a href='/signup'>Sign up</a> or <a href='/login'>Log in</a>
				@endif
			</div>
	
			<div class="search">
				{{ Form::open(array('url' => '/list', 'method' => 'GET')) }}


					{{ Form::label('query','Search for crocodilians:') }} &nbsp;
					{{ Form::text('query') }} &nbsp;
					{{ Form::submit('Search!') }}


				{{ Form::close() }}
			</div>
		</div>

	
		<div span="8">

			<a href='/'><h1 class="logo">Crocodilia</h1></a><br>

		@yield('content')


		@yield('body')

		</div>	

		
		

	<footer>
	</footer>

</body>


</html>
