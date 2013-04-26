<?php namespace Schema;

interface AccountStandards {}

abstract class Account extends \Eloquent implements AccountStandards
{
	protected $table	 = 'accounts';
	protected $field	 = null;

	public $timestamps	 = false;


	/**
	 * Constructs the Account class.
	 * 
	 * @access public
	 * @throws Exception
	 * @return void
	**/
	public function __construct()
	{
		// Throw an exception in case no account field was specified.
		if ( ! $this->field)
		{
			throw new \Exception('A database column (protected $field) for the account name must be specified.');
		}
	}


	/**
	 * Validates the existence of an account.
	 *
	 * @param  mixed $name
	 * @param  string $password
	 * @access public
	 * @return boolean
	**/
	public function exists($name, $password)
	{
		// Declare the account method.
		$method  = 'where'.ucfirst($this->field);
		$account = new static();

		// Return false in case no match was found.
		if ( ! $account->$method($name)->wherePassword(\pandaac::password($password))->count())
		{
			return false;
		}

		unset($account);

		return true;
	}


	/**
	 * Returns the proper name.
	 *
	 * @access public
	 * @return string
	**/
	public function name()
	{
		return $this->{$this->field};
	}


	/**
	 * Returns the proper name field.
	 *
	 * @access public
	 * @return string
	**/
	public function field($field)
	{
		switch (strtolower($field))
		{
			case 'name':
			case 'account':
				return $this->field;

			default:
				return false;
		}
	}
}