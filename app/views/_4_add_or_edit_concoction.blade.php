@extends('_2_logout_bar')

@section('content')
  	<div>Add or edit concoction</div>

  	@yield('add_or_edit_concoction_header')

  	<!--If error, show error user-->
	<?php if ($user_input_error){
		echo "ERROR: " . $user_input_error_message;
	} ?>

	<!--Add concoction form-->
    @yield('add_or_edit_concoction_url')

  	{{ Form::label('title_label', 'Title')}}
  	{{ Form::text('title', $title)}}
  	
  	{{ Form::label('reference_link_label', 'Reference Link')}}
    {{ Form::text('reference_link', $reference_link)}}

  	{{ Form::label('ingredients_label', 'Ingredients')}}
    {{ Form::textarea('ingredients', $ingredients)}}

  	{{ Form::label('directions_label', 'Directions')}}
    {{ Form::textarea('directions', $directions)}}

  	{{ Form::label('tags_label', 'Tags')}}
  	{{ Form::text('tags', $tags)}}

  	{{ Form::label('user_made_this_label', 'I made this!')}}
  	{{ Form::checkbox('user_made_this', $user_made_this)}}

	@yield('add_or_edit_concoction_submit')

  	{{ Form::close() }}
@stop