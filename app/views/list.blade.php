@extends('_master')




@section('head')
	<link rel="stylesheet" href="crocodilians.css" type="text/css">
@stop


@section('title')
	All your Crocodilians
@stop


@section('content')


	View as:
	<a href='/list/json' target='_blank'>JSON</a> | 
	<a href='/list/pdf' target='_blank'>PDF</a>


	<br><br>


	@if(!isset(trim($query)))
		<p>You searched for <strong>{{{ $query }}}</strong></p>


		@if(count($crocodilians) == 0)
			<p>No matches found</p>
		@endif


	@endif


	@foreach($crocodilians as $name => $crocodilian)


		<section>
			
			<img class='image' src='{{ $crocodilian['image'] }}'>


			<h2>{{ $crocodilian['name'] }}</h2>


			 {{ $crocodilian['species'] }}

			
			<p>
				{{ $crocodilian['origin'] }}
			</p>

			<p>
				{{ $crocodilian['appearance'] }}
			</p>


		</section>


	@endforeach


@stop
