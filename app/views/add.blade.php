@extends('_master')


@section('title')
	Add a new croc
@stop


@section('content')


	<h1>Add a New Croc</h1>




	{{ Form::open(array('url' => '/add', 'method' => 'POST')) }}


		Name: {{ Form::text('name') }} <br>
		Species: {{ Form::text('species') }} <br>
		Origin: {{ Form::text('origin') }} <br>
		Appearance: {{ Form::text('appearance') }} <br>
		Image: {{ Form::text('image') }} <br>


		{{ Form::submit('Save!') }}


	{{ Form::close() }}




@stop