@extends('_master')


@section('title')
	Edit Croc
@stop

@section('content')


	{{ Form::model($croc, ['method' => 'post', 'action' => ['CrocController@postEdit', $croc->id]]) }}


		<h2>Update: {{ $croc->name }}</h2>


		<div class='form-group'>
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name') }}
		</div>


		<div class='form-group'>
			{{ Form::label('family', 'Family') }}
			{{ Form::text('family') }}
		</div>


		<div class='form-group'>
			{{ Form::label('species', 'Species') }}
			{{ Form::text('species') }}
		</div>


		<div class='form-group'>
			{{ Form::label('habitat', 'Habitat') }}
			{{ Form::text('habitat') }}
		</div>


		<div class='form-group'>
			{{ Form::label('appearance', 'Appearance') }}
			{{ Form::text('appearance') }}
		</div>

		<div class='form-group'>
			{{ Form::label('image', 'Image') }}
			{{ Form::text('image') }}
		</div>

		<div class='form-group'>
			{{ Form::label('fact1', 'Interesting Fact') }}
			{{ Form::text('fact1') }}
		</div>

		<div class='form-group'>
			{{ Form::label('fact2', 'Interesting Fact') }}
			{{ Form::text('fact2') }}
		</div>

		<div class='form-group'>
			{{ Form::label('fact3', 'Interesting Fact') }}
			{{ Form::text('fact3') }}
		</div>


		{{ Form::submit('Save') }}


	{{ Form::close() }}


@stop
