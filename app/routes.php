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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);


/*
|--------------------------------------------------------------------------
| Account
|--------------------------------------------------------------------------
|
| Register all of the routes for the Account controller here.
|
*/

Route::get('account', 'AccountController@index');
Route::get('account/login', ['as' => 'login', 'uses' => 'AccountController@login']);
Route::post('account/login', 'AccountController@processLogin');
Route::get('account/create', 'AccountController@create');
Route::post('account/create', 'AccountController@processCreation');


/*
|--------------------------------------------------------------------------
| 404
|--------------------------------------------------------------------------
|
| Decide what to display when the user visits a page that does not exist.
|
*/

App::missing(function($exception)
{
	// Set the 404 page title.
	App::bind('themeTitle', function()
	{
		return Lang::get('pandaac/general.title404');
	});

    return Response::view('404', array(), 404);
});


/*
|--------------------------------------------------------------------------
| GD Routes
|--------------------------------------------------------------------------
|
| Decide what to display when the user visits a page that does not exist.
|
*/

Route::get('captcha', ['before' => 'captcha', function()
{

	if ( ! Session::has('captcha'))
	{
		#die;
	}

	$captcha = new GD\Captcha\Image(new GD\Font(Theme::path('fonts/Cabaret.ttf')));
	echo $captcha->generate();

}]);