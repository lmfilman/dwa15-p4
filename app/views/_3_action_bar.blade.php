@extends('_2_logout_bar')

@section('content')
  <div>Action bar
  	<a href='/add-concoction'>Add concoction</a>

	{{ Form::open(array('url'=>'/search-keeper')) }}
	{{ Form::text('query')}}
	{{ Form::submit('Search!') }}
	{{ Form::close() }}
  </div>
  @yield('main_content')
@stop