@extends('_2_logout_bar')

@section('content')
	<div class="container">
		<div>
			
	  		<div class="pull-right col-md-6">
	  			{{ Form::open(array('url'=>'/search-keeper')) }}
	  			{{ Form::text('query')}}
				{{ Form::submit('Search!', array("class"=>"btn btn-sm btn-primary")) }}
				{{ Form::close() }}
	  		</div>
	  		
			<a class="col-md-4 btn btn-sm btn-success" href='/add-concoction'>Add concoction</a>
	    </div>
	</div>
  @yield('main_content')
@stop