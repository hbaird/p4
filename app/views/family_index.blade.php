@extends('_master')

@section('title')
	All your Crocs
@stop

@section('head')
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="styles/crocs.css" type="text/css">
@stop

@section('content')


	View as:
	<a href='/croc/json' target='_blank'>JSON</a> | 
	<a href='/croc/pdf' target='_blank'>PDF</a>


	<br><br>

	@foreach($crocs as $name => $croc)


		<section class="croc">
			
			<img class='image' src="{{ $croc['image'] }}">


			<h2>{{ $croc['name'] }}</h2>


			 <h4>{{ $croc['family'] }}</h4>

			<p>
				Official Name: {{ $croc['species'] }}
			</p>

			<p>
				Habitat: {{ $croc['habitat'] }}
			</p>

			<p>
				Appearance: {{ $croc['appearance'] }}
			</p>

			Interesting Facts:
			<p>
				{{ $croc['fact1'] }}
			</p>

			<p>
				{{ $croc['fact2'] }}
			</p>

			<p>
				{{ $croc['fact3'] }}
			</p>

			Id: {{ $croc['id'] }}

		</section>


	@endforeach


@stop
