@extends('_5_view_concoction')

@section('view_concoction_content')
	<h1>
		<?php echo $selected_concoction->title; ?>
	</h1>
	
	<br>
	<?php 
		if ($selected_concoction->image_file_name != ""){
			echo "<img src='/images/" . $selected_concoction->image_file_name . "' width=200>";
		} else {
			echo "<img src='/restricted_images/no_image_concoction.png' width=200>";
		}
	?>
	<?php
	  	if ($selected_concoction->user_made_this == 1){
	  		echo "<label name='user_made_this_label' class='label label-success pull-right'>I made this!</label><br>";
	  	}
	?>
	<br>
	<br>
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
	    Options
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	    <li role="presentation"><a role="menuitem" tabindex="-1" 
	    	href= <?php echo "/edit-concoction/" . $selected_concoction->id; ?>>Edit concoction</a></li>
	    <li role="presentation" class="divider"></li>
	    <li role="presentation"><a role="menuitem" tabindex="-1" 
	    	href= <?php echo "/delete-concoction/" . $selected_concoction->id; ?>>Delete concoction</a></li>
	  </ul>
	</div>
	<br>
	

	<div>
		<label>Reference Link:</label>
		<br>
		<?php 
		$reference_link = $selected_concoction->reference_link;
		if ($reference_link == null || $reference_link == ""){
			echo "None";
		} else {
			echo "<a href='" . $reference_link . "'>" . $reference_link . "</a>";
		}
		?>
	</div>
	<br>
	<div>
		<label>Ingredients:</label>
		<p><?php echo $selected_concoction->ingredients; ?></p>
	</div>
	<br>
	<div>
		<label>Directions:</label>
		<p><?php echo $selected_concoction->directions; ?></p>
	</div>
	<br>
	<div>
		<label>Tags:</label>
		<?php
		$tags = $selected_concoction->tags;
		if (count($tags) == 0){
			echo "None";
		} else {
			$tag_names = array();
	  		foreach ($tags as $tag) {
		  		array_push($tag_names, $tag->name);
		  	}
		  	echo join(", ", $tag_names);
		}
		?>
	</div>
	<br>

@stop
