<?php

class FakeAppDataSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
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
		$chef_b->password = Hash::make('password');
		$chef_b->save();

		$marie_c = new User;
		$marie_c->name = 'Marie Callendar';
		$marie_c->email = 'marie.callendar12345@yahoo.com';
		$marie_c->password = Hash::make('password');
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
		# ********************************************************
		# ****************** CHICKEN POT PIE *********************	
		# ********************************************************	
		$chicken_pot_pie = new Concoction;
		$chicken_pot_pie->title = 'Chicken pot pie';
		$chicken_pot_pie->reference_link = 'http://allrecipes.com/recipe/chicken-pot-pie-ix/';
		$chicken_pot_pie->image_file_name = 'chickenpotpie.jpg';
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

		# ********************************************************
		# ************** QUINOA AND BLACK BEANS ******************	
		# ********************************************************

		$quinoa_black_beans = new Concoction;
		$quinoa_black_beans->title = 'Quinoa and black beans';
		$quinoa_black_beans->reference_link = 'http://allrecipes.com/recipe/quinoa-and-black-beans/';
		$quinoa_black_beans->image_file_name = 'quinoaandblackbeans.jpg';
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

		# ********************************************************
		# ************** TURKEY BURGERS **************************	
		# ********************************************************

		$turkey_burgers = new Concoction;
		$turkey_burgers->title = 'Delicious Turkey Burgers';
		$turkey_burgers->reference_link = 'http://allrecipes.com/Recipe/Actually-Delicious-Turkey-Burgers/';
		$turkey_burgers->image_file_name = 'turkeyburger.jpg';
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

		# ********************************************************
		# ************** CHOCOLATE CHIP COOKIES ******************	
		# ********************************************************

		$chocolate_chip_cookies = new Concoction;
		$chocolate_chip_cookies->title = 'Best Chocolate Chip Cookies';
		$chocolate_chip_cookies->reference_link = 'http://allrecipes.com/recipe/best-chocolate-chip-cookies/';
		$chocolate_chip_cookies->image_file_name = 'chocolatechipcookies.jpg';
		$chocolate_chip_cookies->ingredients = 	'1 cup butter, softened
												 1 cup white sugar
												 1 cup packed brown sugar
												 2 eggs
												 2 teaspoons vanilla extract
												 3 cups all-purpose flour
												 1 teaspoon baking soda
												 2 teaspoons hot water
												 1/2 teaspoon salt
												 2 cups semisweet chocolate chips
												 1 cup chopped walnuts';
		$chocolate_chip_cookies->directions = 	'
										1. Preheat oven to 350 degrees F (175 degrees C).
										2. Cream together the butter, white sugar, and brown sugar until smooth. Beat in the eggs one at a time, then stir in the vanilla. Dissolve baking soda in hot water. Add to batter along with salt. Stir in flour, chocolate chips, and nuts. Drop by large spoonfuls onto ungreased pans.
										3. Bake for about 10 minutes in the preheated oven, or until edges are nicely browned.';

		//TODO: $chocolate_chip_cookies->photo = '';

		$chocolate_chip_cookies->user()->associate($chef_b);
		$chocolate_chip_cookies->save();

		$chocolate_chip_cookies->tags()->attach($dessert); 
		$chocolate_chip_cookies->tags()->attach($yummy); 
		$chocolate_chip_cookies->tags()->attach($comfort); 

		# ********************************************************
		# ************************ SANGRIA ***********************	
		# ********************************************************

		$sangria = new Concoction;
		$sangria->title = 'Sangria! Sangria!';
		$sangria->reference_link = 'http://allrecipes.com/recipe/sangria-sangria/';
		$sangria->image_file_name = 'sangria.jpg';
		$sangria->ingredients = 	'1/2 cup brandy
									 1/4 cup lemon juice
									 1/3 cup frozen lemonade concentrate
									 1/3 cup orange juice
									 1 (750 milliliter) bottle dry red wine
									 1/2 cup triple sec
									 1 lemon, sliced into rounds
									 1 orange, sliced into rounds
									 1 lime, sliced into rounds
									 1/4 cup white sugar (optional)
									 8 maraschino cherries
									 2 cups carbonated water (optional)';
		$sangria->directions = 	'
										In a large pitcher or bowl, mix together the brandy, lemon juice, lemonade concentrate, orange juice, red wine, triple sec, and sugar. Float slices of lemon, orange and lime, and maraschino cherries in the mixture. Refrigerate overnight for best flavor. For a fizzy sangria, add club soda just before serving.';

		//TODO: $sangria->photo = '';

		$sangria->user()->associate($marie_c);
		$sangria->save();

		$sangria->tags()->attach($drink); 
		$sangria->tags()->attach($pricey); 

		# ********************************************************
		# ********** BAKED GARLIC PARMESAN CHICKEN ***************	
		# ********************************************************

		$baked_garlic_parm_chicken = new Concoction;
		$baked_garlic_parm_chicken->title = 'Baked Garlic Parmesan Chicken';
		$baked_garlic_parm_chicken->reference_link = 'http://allrecipes.com/recipe/baked-garlic-parmesan-chicken/';
		$baked_garlic_parm_chicken->image_file_name = 'garlicchicken.jpg';
		$baked_garlic_parm_chicken->ingredients = 	'2 tablespoons olive oil
				 1 clove garlic, minced
				 1 cup dry bread crumbs
				 2/3 cup grated Parmesan cheese
				 1 teaspoon dried basil leaves
				 1/4 teaspoon ground black pepper
				 6 skinless, boneless chicken breast halves skinless, boneless chicken breast halves';
		$baked_garlic_parm_chicken->directions = 	'
										1. Preheat oven to 350 degrees F (175 degrees C). Lightly grease a 9x13 inch baking dish.
2. In a bowl, blend the olive oil and garlic. In a separate bowl, mix the bread crumbs, Parmesan cheese, basil, and pepper. Dip each chicken breast in the oil mixture, then in the bread crumb mixture. Arrange the coated chicken breasts in the prepared baking dish, and top with any remaining bread crumb mixture.
3. Bake 30 minutes in the preheated oven, or until chicken is no longer pink and juices run clear.';

		//TODO: $baked_garlic_parm_chicken->photo = '';

		$baked_garlic_parm_chicken->user()->associate($chef_b);
		$baked_garlic_parm_chicken->save();

		$baked_garlic_parm_chicken->tags()->attach($dinner); 
		$baked_garlic_parm_chicken->tags()->attach($main);

		# ********************************************************
		# ********** CREAMY TOMATO BASIL SOUP ********************	
		# ********************************************************

		$creamy_tomato_basil_soup = new Concoction;
		$creamy_tomato_basil_soup->title = 'Rich and Creamy Tomato Basil Soup';
		$creamy_tomato_basil_soup->reference_link = 'http://allrecipes.com/recipe/rich-and-creamy-tomato-basil-soup/';
		$creamy_tomato_basil_soup->image_file_name = 'creamytomatosoup.jpg';
		$creamy_tomato_basil_soup->ingredients = 	'4 tomatoes - peeled, seeded and diced
							 4 cups tomato juice
							 14 leaves fresh basil
							 1 cup heavy whipping cream
							 1/2 cup butter
							 salt and pepper to taste';
		$creamy_tomato_basil_soup->directions = 	'
										1. Place tomatoes and juice in a stock pot over medium heat. Simmer for 30 minutes. Puree the tomato mixture along with the basil leaves, and return the puree to the stock pot.
2. Place the pot over medium heat, and stir in the heavy cream and butter. Season with salt and pepper. Heat, stirring until the butter is melted. Do not boil.';

		//TODO: $creamy_tomato_basil_soup->photo = '';

		$creamy_tomato_basil_soup->user()->associate($chef_b);
		$creamy_tomato_basil_soup->save();

		$creamy_tomato_basil_soup->tags()->attach($soup); 
		$creamy_tomato_basil_soup->tags()->attach($side);
		$creamy_tomato_basil_soup->tags()->attach($yummy);
		$creamy_tomato_basil_soup->tags()->attach($vegetarian);

		# ********************************************************
		# ********************** CHICKEN MOLE ********************	
		# ********************************************************

		$chicken_mole = new Concoction;
		$chicken_mole->title = 'Chicken Mole';
		$chicken_mole->reference_link = 'http://www.epicurious.com/recipes/food/views/Chicken-Mole-352649';
		$chicken_mole->image_file_name = '';
		$chicken_mole->ingredients = 	'3 tablespoons (or more) peanut oil (preferably unrefined), divided
							5 pounds skinless boneless chicken thighs
							3 cups low-salt chicken broth
							2 cups orange juice
							1 1/4 pounds onions, sliced
							1/2 cup sliced almonds
							6 large garlic cloves, sliced
							4 teaspoons cumin seeds
							4 teaspoons coriander seeds
							4 ounces dried pasilla chiles,* stemmed, seeded, torn into 1-inch pieces, rinsed
							1 ounce dried negro chiles,* stemmed, seeded, torn into 1-inch pieces, rinsed
							1/4 cup raisins
							4 3 x 1/2-inch strips orange peel (orange part only)
							1 1/2 teaspoons dried oregano
							1 3.1-ounce disk Mexican chocolate,** chopped
							Chopped fresh cilantro
							Warm flour tortillas
							';
		$chicken_mole->directions = 	'Heat 1 tablespoon oil in heavy large pot over medium-high heat. Sprinkle chicken on both sides with salt and pepper. Working in batches, add chicken to pot; sauté until lightly browned, adding more oil by tablespoonfuls as needed, about 3 minutes per side. Transfer chicken to large bowl.

Return chicken and any juices to pot. Add broth and orange juice; bring just to boil. Reduce heat to medium-low; cover and simmer until chicken is tender and just cooked through, about 25 minutes.

Meanwhile, heat 2 tablespoons oil in heavy large saucepan over medium-high heat. Add onions and sauté until golden brown, about 18 minutes. Reduce heat to medium. Add almonds, garlic, cumin, and coriander. Sautéuntil nuts and garlic begin to color, about 2 minutes. Add chiles and stir until beginning to soften, about 2 minutes.

Using tongs, transfer chicken to large bowl. Pour chicken cooking liquid into saucepan with onion mixture (reserve pot). Add raisins, orange peel, and oregano to saucepan. Cover and simmer until chiles are very soft, stirring occasionally, about 30 minutes. Remove from heat; add chocolate. Let stand until chocolate melts and sauce mixture cools slightly, about 15 minutes.

Working in small batches, transfer sauce mixture to blender and puree until smooth; return to reserved pot. Season sauce to taste with salt and pepper. Coarsely shred chicken and return to sauce; stir to coat. DO AHEAD: Can be made 3 days ahead. Chill until cold, then cover and keep chilled. Rewarm over low heat before serving.

Transfer chicken mole to bowl. Sprinkle with cilantro. Serve with warm tortillas.';

		//TODO: $chicken_mole->photo = '';

		$chicken_mole->user()->associate($marie_c);
		$chicken_mole->save();

		$chicken_mole->tags()->attach($main); 
		$chicken_mole->tags()->attach($pricey);

		# ********************************************************
		# ***************** PEANUT BUTTER AND JELLY **************	
		# ********************************************************

		$pb_and_j = new Concoction;
		$pb_and_j->title = 'Peanut butter and jelly';
		$pb_and_j->ingredients = 	'Peanut butter, jelly, & bread';
		$pb_and_j->directions = 	'Spread peanut butter on one slice of bread. Spread jelly on the other slice.  Stick them together.';
		$pb_and_j->reference_link = '';
		$pb_and_j->image_file_name = '';
		$pb_and_j->user_made_this = true;
		$pb_and_j->user()->associate($chef_b);
		$pb_and_j->save();


	}

}
