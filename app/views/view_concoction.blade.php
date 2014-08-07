@extends('_5_view_concoction')

@section('view_concoction_content')
	<h1>
		<?php echo $selected_concoction->title; ?>
	</h1>
	<a href= <?php echo "/edit-concoction/" . $selected_concoction->id; ?>>Edit Concoction</a>
	<?php 
		if ($selected_concoction->image_file_name != ""){
			echo "<img src='/images/" . $selected_concoction->image_file_name . "' width=150>";
		}
	?>
	<div>
		<label>Reference Link:</label>
		<?php 
		$reference_link = $selected_concoction->reference_link;
		if ($reference_link == null || $reference_link == ""){
			echo "None";
		} else {
			echo "<a href='" . $reference_link . "'>" . $reference_link . "</a>";
		}
		?>
	</div>
	
	<div>
		<label>Ingredients:</label>
		<p><?php echo $selected_concoction->ingredients; ?></p>
	</div>
	<div>
		<label>Directions:</label>
		<p><?php echo $selected_concoction->directions; ?></p>
	</div>
	<div>
		<label>User made this:</label>
		<p><?php echo $selected_concoction->user_made_this; ?></p>
	</div>

@stop
