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

Route::get('test', function()
{

});

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
Route::get('account/logout', 'AccountController@logout');
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

Route::get('captcha/{refresh?}', ['before' => 'phpGD', function($refresh = false)
{

	// If no session has been set for the captcha, generate one.
	if ($refresh or (! Session::has('captcha') or ! Cache::get('captcha-'.Session::get('captcha'))))
	{
		if ($refresh)
		{
			// Reset the refresh limit in case 5 minutes have passed.
			if (Session::get('captcha-refreshes-time') + (5 * 60 * 60) < time())
			{
				Session::forget('captcha-refreshes');
				Session::forget('captcha-refreshes-time');
			}

			// Redirect back in case the refresh limit has been met.
			if (Session::get('captcha-refreshes') >= 5)
			{
				return Redirect::back();
			}

			// Delete the captcha image before creating a new one.
			Cache::forget('captcha-'.Session::get('captcha'));
			Session::forget('captcha');	

			// Increase the amount of refreshes.
			Session::put('captcha-refreshes', (int) Session::get('captcha-refreshes') + 1);
			Session::put('captcha-refreshes-time', time());
		}

		$captcha = new GD\Captcha\Image(new GD\Font(Theme::path('fonts/Cabaret.ttf')));
		$captcha->generate();

		return $refresh ? Redirect::back() : Redirect::to('captcha');
	}

	// Display the captcha.
	GD\Processor::display(Cache::get('captcha-'.Session::get('captcha')));

}]);