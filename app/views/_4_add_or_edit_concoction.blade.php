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

    <?php 
      if ($image_file_name != null && $image_file_name != ""){
          echo "<img src='/images/" . $image_file_name . "' height=150 width=150>";
        } else {
          echo "<img src='/images/no_image_concoction.png' height=150 width=150>";
        }
    ?>
    {{ Form::file('file')}}

  	{{ Form::label('ingredients_label', 'Ingredients')}}
    {{ Form::textarea('ingredients', $ingredients)}}

  	{{ Form::label('directions_label', 'Directions')}}
    {{ Form::textarea('directions', $directions)}}

  	{{ Form::label('tags_header_label', 'Tags')}}

    <?php $all_tags = Tag::all(); ?>
    @foreach ($all_tags as $tag)
      <?php echo $tag->name; ?>
      <?php $check_tag = in_array($tag->name, $concoction_tag_names); ?>
      <input type="checkbox" name= <?php echo $tag->name; ?> <?php if ($check_tag) {echo "checked";} ?>>
    @endforeach

  	<?php echo "I made this!"; ?>
    <input type="checkbox" name="user_made_this" <?php if ($user_made_this) {echo "checked";} ?>>

	 @yield('add_or_edit_concoction_submit')

  	{{ Form::close() }}
@stop