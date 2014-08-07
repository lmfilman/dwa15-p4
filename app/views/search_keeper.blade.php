@extends('_3_action_bar')

@section('main_content')
  <div><?php echo $num_results ?> results for: "<?php echo $query ?>"</div>
  <div>
		<?php
			foreach ($results as $result){
				if ($result->image_file_name != ""){
					echo "<img src='/images/" . $result->image_file_name . "' width=100>";
				}
				echo "<a href='/view-concoction/" . $result->id . "'>" . $result->title . "</a><br>";
			}
		?>
	</div>
@stop