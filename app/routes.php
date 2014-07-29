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
	return View::make('add_concoction');
});
/* TODO :
Route::post('/add-concoction', function()
{
	return View::make('add_concoction');
});
*/
Route::get('/edit-concoction/{id}', function($id)
{
	return View::make('edit_concoction')->with('id', $id);
});
/* TODO :
Route::post('/edit-concoction/{id}', function($id)
{
	return View::make('edit_concoction')->with('id', $id);
});

*/
Route::get('/view-keeper', function()
{
	return View::make('view_keeper');
});

Route::get('/view-concoction/{id}', function($id)
{
	return View::make('view_concoction')->with('id', $id);
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

Route::get('/seed-orm', function() {

	# Clear the tables to a blank slate
	DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
	DB::statement('TRUNCATE users');
	DB::statement('TRUNCATE tags');
	DB::statement('TRUNCATE concoctions');
	DB::statement('TRUNCATE concoction_tag');

	# Users
	$chef_b = new User;
	$chef_b->name = 'Chef Boyardee';
	$chef_b->email = 'chef.boyardee12345@gmail.com';
	$chef_b->password = 'password';
	$chef_b->save();

	$marie_c = new User;
	$marie_c->name = 'Marie Callendar';
	$marie_c->email = 'marie.callendar12345@yahoo.com';
	$marie_c->password = 'password';
	$marie_c->save();

	# Tags (Created using the Model Create shortcut method)
	# Note: Tags model must have `protected $fillable = array('name');` in order for this to work
	$dinner         = Tag::create(array('name' => 'dinner'));
	$lunch       	= Tag::create(array('name' => 'lunch'));
	$breakfast    	= Tag::create(array('name' => 'breakfast'));
	$dessert 		= Tag::create(array('name' => 'dessert'));
	$drink         	= Tag::create(array('name' => 'drink'));
	$pricey       	= Tag::create(array('name' => 'pricey'));
	$comfort   		= Tag::create(array('name' => 'comfort food'));
	$yummy         	= Tag::create(array('name' => 'yummy'));
	$soup         	= Tag::create(array('name' => 'soup'));
	$salad         	= Tag::create(array('name' => 'salad'));
	$side         	= Tag::create(array('name' => 'side'));
	$main		    = Tag::create(array('name' => 'main dish'));
	$vegetarian		= Tag::create(array('name' => 'vegetarian'));

	# Concoctions		
	$chicken_pot_pie = new Concoction;
	$chicken_pot_pie->title = 'Chicken pot pie';
	$chicken_pot_pie->reference_link = 'http://allrecipes.com/recipe/chicken-pot-pie-ix/';
	$chicken_pot_pie->ingredients = 	'1 pound skinless, boneless chicken breast halves
										1 cup sliced carrots
										1 cup frozen green peas
										1/2 cup sliced celery
										2/3 cup butter
										2/3 cup chopped onion
										1/2 cup all-purpose flour
										1 teaspoon salt
										1/2 teaspoon black pepper
										1/2 teaspoon celery seed
										1 1/3 cup milk
										2 (9 inch) unbaked pie crusts (Pillsbury ready made pie crusts)';
	$chicken_pot_pie->directions = '1. Make chicken the Catherine’s spicy soup way (1.5 x the material for 3 breasts), 15 minutes in add carrots, peas, celery to soften.  Drain but save broth for later
									2. Preheat oven to 375 degrees F (220 degrees C.)
									3. In the saucepan over medium heat, cook onions in butter until soft and translucent. Stir in flour, salt, pepper, and celery seed. Slowly stir in 3.5 cups broth and milk. Simmer over medium-low heat until thick. Remove from heat and set aside.
									4. Place the chicken mixture in bottom pie crust. Pour hot liquid mixture over. Cover with top crust, seal edges, and cut away excess dough. Make several small slits in the top to allow steam to escape.
									5. Bake in the preheated oven for 40 to 45 minutes, or until pastry is golden brown and filling is bubbly. Cool for 10 minutes before serving.';

	//TODO: $chicken_pot_pie->photo = '';

	$chicken_pot_pie->user()->associate($marie_c);
	$chicken_pot_pie->save();

	$chicken_pot_pie->tags()->attach($dinner); 
	$chicken_pot_pie->tags()->attach($comfort); 
	$chicken_pot_pie->tags()->attach($yummy); 
	$chicken_pot_pie->tags()->attach($main); 

	$quinoa_black_beans = new Concoction;
	$quinoa_black_beans->title = 'Quinoa and black beans';
	$quinoa_black_beans->reference_link = 'http://allrecipes.com/recipe/quinoa-and-black-beans/';
	$quinoa_black_beans->ingredients = 		'1 teaspoon vegetable oil
											1 onion, chopped
											3 cloves garlic, peeled and chopped
											3/4 cup uncooked quinoa
											1 1/2 cups vegetable broth
											1 teaspoon ground cumin
											1/4 teaspoon cayenne pepper
											salt and pepper to taste
											1 to 2 cups frozen corn kernels
											2 (15 ounce) cans black beans, rinsed and drained
											1/2 cup chopped fresh cilantro';
	$quinoa_black_beans->directions = 	'1. Heat the oil in a medium saucepan over medium heat. Stir in the onion and garlic, and saute until lightly browned.
										2. Mix quinoa into the saucepan and cover with vegetable broth. Season with cumin, cayenne pepper, salt, and pepper. Bring the mixture to a boil. Cover, reduce heat, and simmer 20 minutes,
										3. Stir frozen corn into the saucepan, and continue to simmer about 5 minutes until heated through. Mix in the black beans and cilantro.';

	//TODO: $quinoa_black_beans->photo = '';

	$quinoa_black_beans->user()->associate($marie_c);
	$quinoa_black_beans->save();

	$quinoa_black_beans->tags()->attach($dinner); 
	$quinoa_black_beans->tags()->attach($lunch); 
	$quinoa_black_beans->tags()->attach($salad); 
	$quinoa_black_beans->tags()->attach($vegetarian);

	$turkey_burgers = new Concoction;
	$turkey_burgers->title = 'Delicious Turkey Burgers';
	$turkey_burgers->reference_link = 'http://allrecipes.com/Recipe/Actually-Delicious-Turkey-Burgers/';
	$turkey_burgers->ingredients = 		'2 pounds ground turkey
										< 1/4 cup seasoned bread crumbs
										1 onion diced small
										2 egg whites, lightly beaten
										1/4 cup chopped fresh parsley
										1 clove garlic, peeled and minced
										1 teaspoon salt
										1/4 teaspoon ground black pepper';
	$turkey_burgers->directions = 	'1. In a large bowl, mix ground turkey, seasoned bread crumbs, onion, egg whites, parsley, garlic, salt, and pepper. Form into 10ish patties.
									2. Cook the patties in a medium skillet over low-medium heat, turning a bunch of times, to an internal temperature of 180 degrees F (85 degrees C).  About 15 minutes total';

	//TODO: $turkey_burgers->photo = '';

	$turkey_burgers->user()->associate($chef_b);
	$turkey_burgers->save();

	$turkey_burgers->tags()->attach($dinner); 
	$turkey_burgers->tags()->attach($lunch); 
	$turkey_burgers->tags()->attach($main); 

	echo "Done; check DB for results."; 

});