@extends('_3_action_bar')

@section('main_content')
	<br>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-2 sidebar">
		    	<ul class="nav nav-sidebar">
		    		@foreach ($concoctions as $concoction)
		    			<?php echo 
		    				"<li><a href='/view-concoction/" . 	$concoction->id . "'>" . 
		    													$concoction->title . "</a></li>";
		    			?>
					@endforeach
		        </ul>
		    </div>
		    <div class="col-md-6 container">
		    	@yield('view_concoction_content')
		    </div>
	    </div>
	</div>
@stop
