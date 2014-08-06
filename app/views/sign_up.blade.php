@extends('_1_base_view')

@section('body')
	<a href='/'>Concoction Keeper</a>
  	<div>Sign up</div>

  	<div>
  		{{ Form::open(array('url'=>'/sign-up')) }}
  		
		  {{ Form::label('name_label', 'Name')}}
  		{{ Form::text('name')}}

  		{{ Form::label('email_label', 'Email address')}}
  		{{ Form::text('email')}}

  		{{ Form::label('password_label', 'Password')}}
  		{{ Form::text('password')}}

		  {{ Form::submit('Submit!') }}
		  {{ Form::close() }}
  	</div>
@stop