@extends('_3_action_bar')

@section('main_content')
	<div>
		<label>All other concoctions</label>
		<div>
			<?php
				foreach ($concoctions as $concoction){
					echo "<a href='/view-concoction/" . $concoction->id . "'>" . $concoction->title . "</a><br>";
				}
			?>
		</div>
		@yield('view_concoction_content')

	</div>
@stop
