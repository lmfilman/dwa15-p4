@extends('_3_action_bar')

@section('main_content')
  <br>
  <br>
  <div class="container"><?php echo $num_results ?> results for: "<?php echo $query ?>"</div>
  <br>
	  <div class="table-responsive container">
	  	<table class="table table-striped">
	  		@foreach($results as $result)
	  		<tr>
	  			<th>

	  				<?php
	  				echo "<a href='/view-concoction/" . $result->id . "'>";
					if ($result->image_file_name != ""){
						echo "<img src='/images/" . $result->image_file_name . "' height=100 width=100>";
					} else {
						echo "<img src='/images/no_image_concoction.png' height=100 width=100>";
					}
					echo "</a>";
	  				?>

	  			</th>
	  			<th>
	  				<?php
					echo "<h4><a href='/view-concoction/" . $result->id . "'>";
					echo $result->title;
					echo "</a></h4>";
					?>
	  			</th>
	  			<th>
	  				<?php
	  				$tags = $result->tags;
	  				$tag_names = array();
	  				foreach ($tags as $tag) {
		  				array_push($tag_names, $tag->name);
		  			}
		  			echo join(", ", $tag_names);
					?>
	  			</th>
	  			<th>
	  				<?php
	  				if ($result->user_made_this == 1){
	  					echo "<label name='user_made_this_label' class='label label-success'>I made this!</label>";
	  				}
					?>
	  			</th>
	  		</tr>
	  		@endforeach
	  	</table>
	  </div>

@stop