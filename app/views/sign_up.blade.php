@extends('_1_base_view')

@section('body')
	<a href='/'>Concoction Keeper</a>
  	<div>Sign up</div>

  	<!--If error, show error user-->
	<?php if ($user_input_error){
		echo "ERROR: " . $user_input_error_message;
	} ?>

  	<div>
  		{{ Form::open(array('url'=>'/sign-up')) }}
  		
		{{ Form::label('name_label', 'Name')}}
  		{{ Form::text('name')}}

  		{{ Form::label('email_label', 'Email address')}}
  		{{ Form::text('email')}}

  		{{ Form::label('password_label', 'Password')}}
  		{{ Form::text('password')}}

  		{{ Form::label('confirm_password_label', 'Confirm Password')}}
  		{{ Form::text('confirm_password')}}

		{{ Form::submit('Submit!') }}
		{{ Form::close() }}
  	</div>
@stop