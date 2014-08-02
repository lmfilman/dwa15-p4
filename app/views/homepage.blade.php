@extends('_1_base_view')

@section('body')
	<h1>Concoction Keeper</h1>
	<div>
		<h2>Login</h2>
			<!--If error, show error user-->
			<?php 
				$user_input_error = false;
				if ($user_input_error){
				echo "ERROR: " . $user_input_error_message;
			} ?>
	  	<div>
	  		Email ____ Password _____ Submit
	  	</div>
	</div>
	or
	<div>
		<h2>New to Concoction Keeper?</h2>
		<a href="/sign-up">Sign up!</a>
	</div>
@stop