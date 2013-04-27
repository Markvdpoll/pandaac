<?php

/**
 * Validates the existence of an account.
 *
 *	Validator::make(Input::only('password'), ['password' => 'validate_credentials:account,name']);
 *
 * @param  string $accountField
 * @access public
 * @return boolean
**/
Validator::extend('validate_credentials', function($attribute, $password, $parameters)
{
	// Get the account name and its database field.
	$account = Input::get($parameters[0]);
	$field   = $parameters[1];

	return Auth::validate([$field => $account, 'password' => $password]);
});