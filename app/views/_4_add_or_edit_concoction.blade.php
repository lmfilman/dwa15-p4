@extends('_2_logout_bar')

@section('content')
  <div class="container">
    <?php
      if ($user_input_error){
        echo "<div class='alert alert-danger container'>" . $user_input_error_message . "</div>";
      }
    ?>

  	@yield('add_or_edit_concoction_header')

    <!--Add concoction form-->
    @yield('add_or_edit_concoction_url')

    <br>
    {{ Form::label('title_label', 'Title')}}
    {{ Form::text('title', $title, array("class" => "form-control"))}}
    
    <br>
    <?php 
      if ($image_file_name != null && $image_file_name != ""){
          echo "<img src='/images/" . $image_file_name . "' height=150 width=150>";
        } else {
          echo "<img src='/images/no_image_concoction.png' height=150 width=150>";
        }
    ?>
    <br>
    <br>
    {{ Form::file('file')}}

    <br>
  	{{ Form::label('reference_link_label', 'Reference Link')}}
    {{ Form::text('reference_link', $reference_link, array("class" => "form-control"))}}

    <br>
  	{{ Form::label('ingredients_label', 'Ingredients')}}
    <br>
    {{ Form::textarea('ingredients', $ingredients, array("class" => "form-control"))}}
    <br>
  	{{ Form::label('directions_label', 'Directions')}}
    <br>
    {{ Form::textarea('directions', $directions, array("class" => "form-control"))}}

    <br>
    <br>

  	{{ Form::label('tags_header_label', 'Tags')}}
    <br>

    <div class="table-responsive container">
      <table class="table">
        <tr>
          <?php $all_tags = Tag::all(); ?>
        @foreach($all_tags as $tag)
          <th>
            <span>
              <?php echo $tag->name; ?>
              <?php $check_tag = in_array($tag->name, $concoction_tag_names); ?>
              <input type="checkbox" name= <?php echo $tag->name; ?> <?php if ($check_tag) {echo "checked";} ?>>
            </span>
          </th>  
        @endforeach
        </tr>
      </table>
    </div>

    <br>
    <div class='pull-right'>
      <input type="checkbox" name="user_made_this" <?php if ($user_made_this) {echo "checked";} ?>>
      <label name='user_made_this_label' class='label label-success'>I made this!</label>
    </div>
    <br>
    <br>
	 @yield('add_or_edit_concoction_submit')
  </div>
  	{{ Form::close() }}
    <br>
    <br>
@stop