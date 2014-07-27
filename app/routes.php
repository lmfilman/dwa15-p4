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