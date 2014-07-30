@extends('_master')


@section('title')
	Welcome to Crocodilians
@stop


@section('content')
	<h1>Crocodilians</h1>


	<p>Learn all about crocodilians!<br>

	Welcome to where everything great about the order of Crocodilia is celebrated.<br>

	There are three families of the order of Crocodilia: Crocodylidae, Alligatoridae, and Gavialidae.
	You can think of them as crocodiles, alligators, and the weird-looking Gharials. <br> <br>

	<a href='/list'>View all Crocodilians</a><br> 
	


	<br><br>


	{{ Form::open(array('url' => '/list', 'method' => 'GET')) }}


		{{ Form::label('query','Search for crocodilians:') }} &nbsp;
		{{ Form::text('query') }} &nbsp;
		{{ Form::submit('Search!') }}


	{{ Form::close() }}




@stop