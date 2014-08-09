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

Route::get('/', array('before'=> 'guest', function()
{
	return View::make('homepage');
}));


Route::post('/', array('before'=> 'csrf', function()
{
	$email = Input::get('email');
	$password = Input::get('password');

	if (Auth::attempt(array('email' => $email, 'password' => $password), true)){
		$user= User::where("email", "=", $email)->first();

		return Redirect::intended('/overview')->with('flash_message', 'Welcome Back '. $user->name .'!');
	} else {
		return Redirect::to('/')->with('flash_message', 'Login unsuccessful: Please edit your email or password field(s).');
	}
}));

Route::get('/log-out', array('before'=>'auth', function()
{
	Auth::logout();

	return Redirect::to('/');
}));

Route::get('/sign-up', array('before'=>'guest', function()
{
	return View::make('sign_up');
}));

Route::post('/sign-up', array('before' => 'csrf', function()
{
	$user = new User();
	$user->name = Input::get('name');
	$user->email = Input::get('email');
	$user->password = Hash::make(Input::get('password'));

	try{
		$user->save();
	} catch (Exception $e){
		return Redirect::to('/sign-up')->with('flash_message', 'Sign up failed. Please try again.');
	}

	Auth::login($user, true);

	return Redirect::to('/overview');

	//Need to do the following::::
	//Verify email nonempty
	//Verify password nonempty
	//Verify email unique
	//Verify email valid format (includes @, .)
	//Verify passwords match
	//Verify passwords >6 characters
	
}));

Route::get('/add-concoction', array('before' => 'auth', function()
{
	return View::make('add_concoction')
		->with('user_input_error', false)
		->with('user_input_error_message', '')	
		->with('title', '')
		->with('reference_link', '')
		->with('image_file_name', '')
		->with('ingredients', '')
		->with('directions', '')
		->with('concoction_tag_names', array())
		->with('user_made_this', false)
		;
}));

Route::post('/add-concoction', array('before' => 'auth', function()
{
	$user_input_error = false;
	$user_input_error_message = "";
	$title = trim(Input::get('title'));
	$reference_link = trim(Input::get('reference_link')); //Not required

	//Move file to /public/images & Store file name in database
	$image_file_name = "";
	if (Input::hasFile('file')){
		$filename = str_random(12) . ".jpg";
		$file = Input::file('file')->move(public_path() ."/images", $filename);
		$image_file_name = $filename;
	}

	$ingredients = trim(Input::get('ingredients'));
	$directions = trim(Input::get('directions'));

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

	//Get tag names
	$tag_names = array();
	$all_tags = Tag::all();
	foreach ($all_tags as $tag){
		$tag_name = $tag->name;
		$checked_tag = Input::get($tag_name);
		if ($checked_tag){
			array_push($tag_names, $tag_name);
		}
	}

	if ($user_input_error){
		return View::make('add_concoction')
			->with('user_input_error', $user_input_error)
			->with('user_input_error_message', $user_input_error_message)	
			->with('title', $title)
			->with('reference_link', $reference_link)
			->with('ingredients', $ingredients)
			->with('image_file_name', $image_file_name)
			->with('directions', $directions)
			->with('concoction_tag_names', $tag_names)
			->with('user_made_this', $user_made_this)
			;
	} else {

		$user = Auth::user();

		$concoction = new Concoction;
		$concoction->title = $title;
		$concoction->reference_link = $reference_link;
		$concoction->image_file_name = $image_file_name;
		$concoction->ingredients = $ingredients;
		$concoction->directions = $directions;

		$concoction->user_made_this = ($user_made_this == 'on' ? true : false);

		$concoction->user()->associate($user);
		$concoction->save();

		foreach ($tag_names as $tag_name){
			$tag = Tag::where('name', '=', $tag_name)->first();
			$concoction->tags()->attach($tag);
		}


		return Redirect::to('/overview');
	}

	
}));

Route::get('/delete-concoction/{id}', array('before' => 'auth|editor', function($id)
{
	
	$concoction = Concoction::findOrFail($id);
	//Detach all tags
	$old_concoction_tags = $concoction->tags;
	foreach ($old_concoction_tags as $tag){
		$concoction->tags()->detach($tag);
	}
	$concoction->delete();

	return Redirect::to('/overview');

}));

Route::get('/edit-concoction/{id}', array('before' => 'auth|editor', function($id)
{
	//Get concoction from database by id
	$concoction = Concoction::findOrFail($id);

	//Get tag names
	$concoction_tag_objects = $concoction->tags;
	$concoction_tag_names = array();
	foreach ($concoction_tag_objects as $tag){
		array_push($concoction_tag_names, $tag->name);
	}

	return View::make('edit_concoction')
		->with('user_input_error', false)
		->with('user_input_error_message', '')	
		->with('title', $concoction->title)
		->with('reference_link', $concoction->reference_link)
		->with('image_file_name', $concoction->image_file_name)
		->with('ingredients', $concoction->ingredients)
		->with('directions', $concoction->directions)
		->with('concoction_tag_names', $concoction_tag_names)
		->with('user_made_this', $concoction->user_made_this)

		->with('id', $id)
		;	

}));

Route::post('/edit-concoction/{id}', array('before' => 'auth|editor', function($id)
{
	$user_input_error = false;
	$user_input_error_message = "";
	$title = trim(Input::get('title'));
	$reference_link = trim(Input::get('reference_link')); //Not required

	$image_file_name = "";
	if (Input::hasFile('file')){
		$filename = str_random(12) . ".jpg";
		$file = Input::file('file')->move(public_path() ."/images", $filename);
		$image_file_name = $filename;
	}

	$ingredients = trim(Input::get('ingredients'));
	$directions = trim(Input::get('directions'));
	
	//Get tag names
	$tag_names = array();
	$all_tags = Tag::all();
	foreach ($all_tags as $tag){
		$tag_name = $tag->name;
		$checked_tag = Input::get($tag_name);
		if ($checked_tag){
			array_push($tag_names, $tag_name);
		}
	}

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
			->with('image_file_name', $image_file_name)
			->with('ingredients', $ingredients)
			->with('directions', $directions)
			->with('concoction_tag_names', $tags)
			->with('user_made_this', $user_made_this)
			->with('id', $id)
			;
	} else {
		//DIFFERENT FROM ADD::::
		$concoction = Concoction::findOrFail($id);

		$concoction->title = $title;
		$concoction->reference_link = $reference_link;
		if ($image_file_name != ""){
			$concoction->image_file_name = $image_file_name;	
		}
		$concoction->ingredients = $ingredients;
		$concoction->directions = $directions;
		
		$concoction->user_made_this = ($user_made_this == 'on' ? true : false);

		$concoction->save();

		//Detach all tags
		$old_concoction_tags = $concoction->tags;
		foreach ($old_concoction_tags as $tag){
			$concoction->tags()->detach($tag);
		}
		//Attach new tags
		foreach ($tag_names as $tag_name){
			$tag = Tag::where('name', '=', $tag_name)->first();
			$concoction->tags()->attach($tag);
		}

		return Redirect::to('/overview');
	}
}));

Route::get('/overview', array('before' => 'auth', function()
{
	$concoctions = get_logged_in_users_concoctions();
	return View::make('overview')
			->with('concoctions', $concoctions);

}));

Route::get('/view-concoction/{id}', array('before' => 'auth|editor', function($id)
{
	$concoctions = get_logged_in_users_concoctions();
	$selected_concoction = Concoction::findOrFail($id);	
	return View::make('view_concoction')
			->with('selected_concoction', $selected_concoction)
			->with('concoctions', $concoctions);
	

}));

Route::get('/search-keeper', array('before' => 'auth', function()
{
	$query = "";
	$collection = get_logged_in_users_concoctions();
	$results = get_search_results($collection, $query);
	$num_results = count($results);

	return View::make('search_keeper')
				->with('query', $query)
				->with('results', $results)
				->with('num_results', $num_results);
				;
}));

Route::post('/search-keeper', array('before' => 'auth', function()
{
	$query = trim(Input::get('query'));
	$collection = get_logged_in_users_concoctions();
	$results = get_search_results($collection, $query);
	$num_results = count($results);

	return View::make('search_keeper')
				->with('query', $query)
				->with('results', $results)
				->with('num_results', $num_results);
				;
}));

function get_search_results($collection, $query)
{
	$query = strtolower($query);
	//If query is empty string, return all results
	if ($query == ""){
		return $collection;
	} 
	else {
		$pattern = "!\s+!";
		$replacement = " ";
		$query = preg_replace($pattern, $replacement, $query);
		$tokens = explode(" ", $query);

		$matches = array();

		foreach ($collection as $concoction){

			$document = $concoction->title . " " . $concoction->ingredients . " " . $concoction->directions;
			$document = strtolower($document);
			$match = false;
			foreach ($tokens as $token){
				if (!$match){
					$token = strtolower($token);
					//Check for a match
					if (strpos($document, $token) !== false ){
						$match = true;
					}
				}
			}
			if ($match){
				array_push($matches, $concoction);
			}
		}
		return $matches;
	}
}
function get_logged_in_users_concoctions(){
	$user = Auth::user();
	return Concoction::where('user_id', '=', $user->id)->get();
}

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