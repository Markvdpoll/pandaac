<?php

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
		echo '<div style="background: #fff; padding: 20px; color: #666; font-size: 110%; position: absolute; top: 0; left: 0; right: 0; z-index: 9999;">';
		
		// Loop through all of the arguments and print them using var_dump.
		foreach (func_get_args() as $argument)
		{
			var_dump($argument);
		}

		echo '</div>';
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
		$hash = Config::get('pandaac::server.hash');

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