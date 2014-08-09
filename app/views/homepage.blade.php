@extends('_1_base_view')

@section('body')
	<div class = "container">
		<div>
			@if(Session::get('flash_message'))
		        <div class='alert alert-danger container'>
		          {{ Session::get('flash_message') }}
		        </div>
  			@endif
			<img src='/images/witchesbrew.png' width=750>
			<div class="row container">
				<div class="col-md-4">
					<h2>Log in</h2>
					<div>
				  		{{ Form::open(array('url' => '/')) }}

				  		<table class='table'>
				    		<tr>
				    			<td>{{ Form::label('email_label', 'Email')}}</td>
				    			<td>{{ Form::text('email') }}</td>
				    		</tr>
				    		<tr>
				    			<td>{{ Form::label('password_label', 'Password')}}  </td>
				    			<td>{{ Form::password('password') }}</td>
				    		</tr>	
			    		</table>
			    		
			    		{{ Form::submit('Submit', array('class'=>'btn btn-lg btn-primary')) }}

						{{ Form::close() }}
				  	</div>
				</div>
				<div class="col-md-6">
					<h2>New to Concoction Keeper?</h2>
					<a href="/sign-up" class="btn btn-lg btn-success">
						Sign up!
					</a>
				</div>
			</div>
		</div>
	</div>
@stop