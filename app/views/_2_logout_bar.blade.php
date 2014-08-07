@extends('_1_base_view')

@section('body')
	<a href='/'><img src='/images/header.png' height=75></a>

  	<a href='/log-out'>Logout</a>
  	@yield('content')
@stop