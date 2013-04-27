<?php

class AccountController extends BaseController
{
	/**
	 * Construct the Account controller.
	 *
	 * @access public
	 * @return void
	**/
	public function __construct()
	{
		// Set a global controller title.
		$this->groupTitle('lang::pandaac/account.title');

		// Require the visitor to be authenticated before proceeding.
		$this->beforeFilter('auth', [
			'except' => [
				'login', 
				'processLogin',
				'create',
				'processCreation',
			]
		]);

		// Require the user to NOT be authenticated before proceeding.
		$this->beforeFilter('guest', [
			'only' => [
				'login', 
				'processLogin',
				'create',
				'processCreation',
			],
		]);

		parent::__construct();
	}


	/**
	 * The default landing page for the Accounts controller.
	 *
	 * @access public
	 * @return View
	**/
	public function index()
	{
		$this->title('lang::pandaac/account.title', true);

		$this->layout->nest('content', 'account.index', [
			'user' => Auth::user(),
		]);
	}


	/**
	 * Display the login form.
	 *
	 * @access public
	 * @return View
	**/
	public function login()
	{
		$this->title('lang::pandaac/account.login.submit', true);

		$this->layout->nest('content', 'account.login', [
			'errors' => Session::get('errors'),
		]);
	}


	/**
	 * Process the login form.
	 *
	 * @access public
	 * @return void
	**/
	public function processLogin()
	{
		Input::flash();

		// Get the name field.
		$name = SchemaObject::create('Account')->field('name');
		// Define the credentials.
		$credentials = [
			$name		 => Input::get('account'),
			'password'	 => Input::get('password'),
		];


		// Create a validator object.
		$validator = Validator::make(Input::all(), [
			'account'	 => 'required',
			'password'	 => 'required|validate_credentials:account,'.$name,
		]);

		// If validation fails, redirect the user to the login form.
		if ($validator->fails())
		{
			return Redirect::route('login')->withErrors($validator);
		}


		// Attempt to authenticate the user.
		if ( ! Auth::attempt($credentials, (boolean) Input::get('remember')))
		{
			return Redirect::route('login')->withErrors(Lang::get('validation.account.improper_login'));
		}

		return Redirect::to('account');
	}


	/**
	 * Process logging out.
	 *
	 * @access public
	 * @return Redirect
	**/
	public function logout()
	{
		Auth::logout();

		return Redirect::route('login');
	}


	/**
	 * Display the create form.
	 *
	 * @access public
	 * @return void
	**/
	public function create()
	{
		$this->title('lang::pandaac/account.registration.title', true);

		$this->layout->nest('content', 'account.create', [
			'errors' => Session::get('errors'),
		]);
	}


	/**
	 * Process the create form.
	 *
	 * @access public
	 * @return void
	**/
	public function processCreation()
	{
		Input::flash();

		// Get the name field.
		$name = SchemaObject::create('Account')->field('name');
		// Define all the validation rules.
		$rules = [
			'account'	 => 'required|unique:accounts,'.$name,
			'password'	 => 'required',
			'repeat'	 => 'required|same:password',
			'email'		 => 'required|email|unique:accounts,email',
			'terms'		 => 'accepted',
			'captcha'	 => GD\Processor::isGDEnabled() ? ['required', 'regex:/^('.preg_quote(Session::get('captcha'), '/').')$/i'] : false
		];

		// Create a validator object.
		$validator = Validator::make(Input::all(), $rules);


		// If validation fails, redirect the user to the login form.
		if ($validator->fails())
		{
			return Redirect::to('account/create')->withErrors($validator);
		}

		// Create the specified account.
		$account = $account->register(Input::get('account'), Input::get('password'), Input::get('email'));
		// Log in with the user.
		Auth::loginUsingId($account->id);

		// Remove the cached image of the captcha, and the session that belongs to it.
		Cache::forget('captcha-'.Session::get('captcha'));
		Session::forget('captcha');


		return Redirect::to('account');
	}
}