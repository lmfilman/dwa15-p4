@extends('_3_action_bar')

@section('main_content')
  <div><?php echo $num_results ?> results for: "<?php echo $query ?>"</div>
  <div>
		<?php
			foreach ($results as $result){
				echo "<a href='/view-concoction/" . $result->id . "'>" . $result->title . "</a><br>";
			}
		?>
	</div>
@stop