@extends('_master')




@section('head')
	<link rel="stylesheet" href="crocs.css" type="text/css">
@stop


@section('title')
	All your Crocs
@stop


@section('content')


	View as:
	<a href='/crocodiles/json' target='_blank'>JSON</a> | 
	<a href='/crocodiles/pdf' target='_blank'>PDF</a>


	<br><br>

	@foreach($crocs as $name => $croc)


		<section>
			
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
