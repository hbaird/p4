@extends('_master')


@section('title')
	Add a New Croc
@stop


@section('content')


	<h1>Add a New Croc</h1>




	{{ Form::open(array('url' => '/croc/create', 'method' => 'POST')) }}


		<div class='form-group'>
			{{ Form::label('name') }} 
			{{ Form::text('name') }}
		</div>


		<div class='form-group'>
			{{ Form::label('species') }} 
			{{ Form::text('species') }}
		</div>


		<div class='form-group'>
			{{ Form::label('region') }} 
			{{ Form::text('region') }}
		</div>


		<div class='form-group'>
			{{ Form::label('appearance') }} 
			{{ Form::text('appearance') }}
		</div>


		<div class='form-group'>
			{{ Form::label('image','Image URL') }} 
			{{ Form::text('image') }}
		</div>

		
		{{ Form::submit('Add') }}


	{{ Form::close() }}




@stop
