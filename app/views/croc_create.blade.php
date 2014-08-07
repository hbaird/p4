@extends('_master')


@section('title')
	Add a new croc
@stop

@section('content')


	<h1>Add a New Croc</h1>


	<div class="add">

	{{ Form::open(array('url' => '/add', 'method' => 'POST')) }}


		Name: {{ Form::text('name') }} <br><br>
		Family: {{ Form::text('family') }} <br><br>
		Species: {{ Form::text('species') }} <br><br>
		Habitat: {{ Form::text('habitat') }} <br><br>
		Appearance: {{ Form::text('appearance') }} <br><br>
		Image: {{ Form::text('image') }} <br><br>

		Add some interesting facts:<br><br>
		Fact: {{ Form::text('fact1') }} <br><br>
		Fact: {{ Form::text('fact2') }} <br><br>
		Fact: {{ Form::text('fact3') }} <br><br>


		{{ Form::submit('Save!') }}<br>


	{{ Form::close() }}

	</div>


@stop