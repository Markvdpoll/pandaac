<?php namespace Schema\tfs04;

class Account extends \Schema\Account
{
	protected $field = 'name';


	/**
	 * Register/create an account.
	 *
	 * @param  mixed $account
	 * @param  string $password
	 * @param  string $email
	 * @access public
	 * @return instance
	**/
	public function register($account, $password, $email)
	{
		// Set the required parameters.
		$this->{$this->field('name')}	= $account;
		$this->password					= \pandaac::password($password);
		$this->email					= $email;

		$this->save();

		return $this;
	}
}