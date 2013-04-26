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
		return 'My Account';
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
		// Create a validation.
		$validator = Validator::make(Input::only('account', 'password'), 
		[
			'account'	 => 'required',
			'password'	 => ['required', 'validate_login_credentials:account'],
		], 
		[
			'validate_login_credentials' => Lang::get('pandaac/account.login.fail'),
		]);


		// If validation fails, redirect the user to the login form.
		if ($validator->fails())
		{
			return Redirect::to('account/login')->withErrors($validator);
		}

		return 'Yay, you logged in!!!';
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

		$account = SchemaObject::create('Account');

		// Define all the validation rules.
		$rules = [
			'account'	 => 'required|unique:accounts,'.$account->field('name'),
			'password'	 => 'required',
			'repeat'	 => 'required|same:password',
			'email'		 => 'required|email|unique:accounts,email',
			'terms'		 => 'accepted',
		];

		// If captcha is enabled, include it as a rule.
		if (GD\Processor::isGDEnabled())
		{
			$rules['captcha'] = ['required', 'regex:/^('.preg_quote(Session::get('captcha'), '/').')$/i'];
		}

		// Create a validation.
		$validator = Validator::make(Input::only('account', 'password', 'repeat', 'email', 'captcha', 'terms'), $rules);


		// If validation fails, redirect the user to the login form.
		if ($validator->fails())
		{
			return Redirect::to('account/create')->withErrors($validator);
		}

		// Create the specified account.
		$account->{$account->field('name')}	 = Input::get('account');
		$account->password					 = pandaac::password(Input::get('password'));
		$account->email						 = Input::get('email');
		$account->save();


		// Remove the cached image of the captcha, and the session that belongs to it.
		Cache::forget('captcha-'.Session::get('captcha'));
		Session::forget('captcha');

		return Redirect::to('account');
	}
}