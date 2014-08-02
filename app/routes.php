<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{
	return View::make('homepage');
});

Route::get('/sign-up', function()
{
	return View::make('sign_up');
});

/* TODO : 
Route::post('/sign-up', function()
{
});
*/
Route::get('/add-concoction', function()
{
	return View::make('add_concoction')
		->with('user_input_error', false)
		->with('user_input_error_message', '')	
		->with('title', '')
		->with('reference_link', '')
		->with('ingredients', '')
		->with('directions', '')
		->with('tags', '')
		->with('user_made_this', false)
		;
});

Route::post('/add-concoction', function()
{
	$user_input_error = false;
	$user_input_error_message = "";
	$title = trim(Input::get('title'));
	$reference_link = trim(Input::get('reference_link')); //Not required
	$ingredients = trim(Input::get('ingredients'));
	$directions = trim(Input::get('directions'));
	$tags = trim(Input::get('tags'));						//For now, space separated
	$user_made_this = Input::get('user_made_this');

	//Form validation
	if ($title === '') {
		$user_input_error = true;
		$user_input_error_message = "Your Concoction needs a title!";
	}
	elseif ($ingredients === '') {
		$user_input_error = true;
		$user_input_error_message = "Your Concoction needs ingredients!";
	}
	elseif ($directions === '') {
		$user_input_error = true;
		$user_input_error_message = "Your Concoction needs directions!";
	}

	if ($user_input_error){
		return View::make('add_concoction')
			->with('user_input_error', $user_input_error)
			->with('user_input_error_message', $user_input_error_message)	
			->with('title', $title)
			->with('reference_link', $reference_link)
			->with('ingredients', $ingredients)
			->with('directions', $directions)
			->with('tags', $tags)
			->with('user_made_this', $user_made_this)
			;
	} else {
		//Replace user later
		$chef_boyardee = User::where('name', '=', 'Chef Boyardee')->first();

		$concoction = new Concoction;
		$concoction->title = $title;
		$concoction->reference_link = $reference_link;
		$concoction->ingredients = $ingredients;
		$concoction->directions = $directions;
		if($user_made_this == null){
			$user_made_this = false;
		}
		$concoction->user_made_this = $user_made_this;

		//Replace tags later
		$dinner = Tag::where('name', '=', 'dinner')->first();

		$concoction->user()->associate($chef_boyardee);
		$concoction->save();

		$concoction->tags()->attach($dinner); 

		return Redirect::to('/view-concoction/1234');
	}

	
});

Route::get('/edit-concoction/{id}', function($id)
{
	//Get concoction from database by id
	$concoction = Concoction::findOrFail($id);

	return View::make('edit_concoction')
		->with('user_input_error', false)
		->with('user_input_error_message', '')	
		->with('title', $concoction->title)
		->with('reference_link', $concoction->reference_link)
		->with('ingredients', $concoction->ingredients)
		->with('directions', $concoction->directions)
		->with('tags', $concoction->tags)
		->with('user_made_this', $concoction->user_made_this)

		->with('id', $id)
		;
});

Route::post('/edit-concoction/{id}', function($id)
{
	$user_input_error = false;
	$user_input_error_message = "";
	$title = trim(Input::get('title'));
	$reference_link = trim(Input::get('reference_link')); //Not required
	$ingredients = trim(Input::get('ingredients'));
	$directions = trim(Input::get('directions'));
	$tags = trim(Input::get('tags'));						//For now, space separated
	$user_made_this = Input::get('user_made_this');

	//Form validation
	if ($title === '') {
		$user_input_error = true;
		$user_input_error_message = "Your Concoction needs a title!";
	}
	elseif ($ingredients === '') {
		$user_input_error = true;
		$user_input_error_message = "Your Concoction needs ingredients!";
	}
	elseif ($directions === '') {
		$user_input_error = true;
		$user_input_error_message = "Your Concoction needs directions!";
	}

	if ($user_input_error){
		return View::make('edit_concoction')
			->with('user_input_error', $user_input_error)
			->with('user_input_error_message', $user_input_error_message)	
			->with('title', $title)
			->with('reference_link', $reference_link)
			->with('ingredients', $ingredients)
			->with('directions', $directions)
			->with('tags', $tags)
			->with('user_made_this', $user_made_this)
			->with('id', $id)
			;
	} else {
		//DIFFERENT FROM ADD::::
		$concoction = Concoction::findOrFail($id);

		$concoction->title = $title;
		$concoction->reference_link = $reference_link;
		$concoction->ingredients = $ingredients;
		$concoction->directions = $directions;
		if($user_made_this == null){
			$user_made_this = false;
		}
		$concoction->user_made_this = $user_made_this;


		//Replace tags later
		$dinner = Tag::where('name', '=', 'dinner')->first();

		$concoction->save();

		$concoction->tags()->attach($dinner); 

		return Redirect::to('/view-concoction/1234');
	}
});

Route::get('/view-concoction/{id}', function($id)
{
	//Get concoction from database by id
	$selected_concoction = Concoction::findOrFail($id);
	$concoctions = Concoction::all();
	return View::make('view_concoction')
				->with('selected_concoction', $selected_concoction)
				->with('concoctions', $concoctions);

});

Route::get('/search-keeper', function()
{
	return View::make('search_keeper');
});

Route::get('/debug', function() {

	echo '<pre>';

	echo '<h1>environment.php</h1>';
	$path   = base_path().'/environment.php';

	try {
		$contents = 'Contents: '.File::getRequire($path);
		$exists = 'Yes';
	}
	catch (Exception $e) {
		$exists = 'No. Defaulting to `production`';
		$contents = '';
	}

	echo "Checking for: ".$path.'<br>';
	echo 'Exists: '.$exists.'<br>';
	echo $contents;
	echo '<br>';

	echo '<h1>Environment</h1>';
	echo App::environment().'</h1>';

	echo '<h1>Debugging?</h1>';
	if(Config::get('app.debug')) echo "Yes"; else echo "No";

	echo '<h1>Database Config</h1>';
	print_r(Config::get('database.connections.mysql'));

	echo '<h1>Test Database Connection</h1>';
	try {
		$results = DB::select('SHOW DATABASES;');
		echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
		echo "<br><br>Your Databases:<br><br>";
		print_r($results);
	} 
	catch (Exception $e) {
		echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
	}

	echo '</pre>';

});