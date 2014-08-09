@extends('_1_base_view')

@section('body')

	@if(Session::get('flash_message'))
		<div class='alert alert-success container'>
		    {{ Session::get('flash_message') }}
		</div>
  	@endif
	<div class="container">
		<div class="page-header" role="navigation">
	  		<ul class="nav nav-pills pull-right">
	  			<li>
	  				<a href="/log-out">Log out</a>
	  			</li>
	  		</ul>
			<h3><a href='/'><img src='/images/header.png' width=400></h3>
	    </div>
	</div>

  	@yield('content')

@stop