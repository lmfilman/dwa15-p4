@extends('_4a_add_or_edit_concoction')

@section('title')
  Add concoction
@stop

@section('add_or_edit_concoction')
	<div>Add concoction</div>

	<!--If error, show error user-->
	<?php if ($user_input_error){
		echo "ERROR: " . $user_input_error_message;
	} ?>

	<!--Add concoction form-->
  	{{ Form::open(array('url'=>'/add-concoction')) }}
  	
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

	{{ Form::label('i_made_this_label', 'I made this!')}}
	{{ Form::checkbox('i_made_this', $i_made_this)}}

	{{ Form::submit('Add concoction!') }}

  	{{ Form::close() }}
@stop