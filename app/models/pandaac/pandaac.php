<?php namespace pandaac;

class pandaac
{
	/**
	 * Displays a humanly readable debug monitor.
	 *
	 * @param  mixed ..
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function debug()
	{
		echo \View::make('debug', [
			'arguments' => func_get_args(),
		]);
	}


	/**
	 * Uses the proper hashing method for the passwords across the application.
	 *
	 * @param  string $password
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function password($password)
	{
		// Get the user-specified hashing method.
		$hash = \Config::get('pandaac::server.hash');

		switch (strtolower($hash))
		{
			case 'md5':
				return md5($password);

			case 'sha1':
				return sha1($password);
		}

		return $password;
	}
}