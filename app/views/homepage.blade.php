@extends('_1_base_view')

@section('body')
	<img src='/images/witchesbrew.png' width=800>

	<div>
		<h2>Log in</h2>
		<div>
	  		{{ Form::open(array('url' => '/')) }}

    		{{ Form::label('email_label', 'Email')}}
    		{{ Form::text('email') }}

    		{{ Form::label('password_label', 'Password')}}    		
    		{{ Form::password('password') }}

    		{{ Form::submit('Submit') }}

			{{ Form::close() }}
	  	</div>
	</div>
	or
	<div>
		<h2>New to Concoction Keeper?</h2>
		<a href="/sign-up">Sign up!</a>
	</div>
@stop