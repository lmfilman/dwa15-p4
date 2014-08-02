@extends('_3_action_bar')

@section('main_content')
	<h1>
		<?php echo $concoction->title; ?>
	</h1>
	<div>
		<label>Reference Link:</label>
		<?php 
		$reference_link = $concoction->reference_link;
		if ($reference_link == null || $reference_link == ""){
			echo "None";
		} else {
			echo "<a href='" . $reference_link . "'>" . $reference_link . "</a>";
		}
		?>
	</div>
	
	<div>
		<label>Ingredients:</label>
		<p><?php echo $concoction->ingredients; ?></p>
	</div>
	<div>
		<label>Directions:</label>
		<p><?php echo $concoction->directions; ?></p>
	</div>
	<div>
		<label>User made this:</label>
		<p><?php echo $concoction->user_made_this; ?></p>
	</div>
@stop
