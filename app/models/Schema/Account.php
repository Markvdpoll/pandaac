<?php namespace Schema;

use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableInterface;

interface AccountStandards {}

abstract class Account extends \Eloquent implements AccountStandards, UserInterface, RemindableInterface
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


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}


	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}


	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
}