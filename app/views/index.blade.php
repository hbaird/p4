@extends('_master')


@section('title')
	Welcome to Crocodilia
@stop


@section('content')
	<h1>Crocodilia</h1>


	<p>Learn all about crocodilians!<br>

	Welcome to where everything great about the order of Crocodilia is celebrated.<br>

	There are three families of the order of Crocodilia: Crocodylidae, Alligatoridae, and Gavialidae.<br>
	You might know them by their more common names: 
	<a href='/crocodiles'>crocodiles</a>, <a href='/alligators'>alligators</a>, and the funny-looking <a href='/gharials'>gharials</a>. <br> <br>

	<a href='/list'>View all Crocs</a><br> 
	


	<br><br>


	{{ Form::open(array('url' => '/list', 'method' => 'GET')) }}


		{{ Form::label('query','Search for crocodilians:') }} &nbsp;
		{{ Form::text('query') }} &nbsp;
		{{ Form::submit('Search!') }}


	{{ Form::close() }}




@stop