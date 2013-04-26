<?php

/**
 * Validates the existence of an account.
 *
 *	Validator::make(Input::only('password'), ['password' => 'validate_login_credentials:account']);
 *
 * @param  string $accountField
 * @access public
 * @return boolean
**/
Validator::extend('validate_login_credentials', function($attribute, $password, $parameters)
{
	// Get the account name/number.
	$name = Input::get($parameters[0]);

	// Create a schema based object.
	$account = SchemaObject::create('Account');

	return $account->exists($name, $password) ? true : false;
});