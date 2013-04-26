<?php

class SchemaObject
{
	/**
	 * Returns a schema-based object.
	 *
	 * @param  string $object
	 * @param  mixed ...
	 * @access public
	 * @return instance
	**/
	public static function create($object)
	{
		// Get the parameters.
		$arguments = func_get_args();
		unset($arguments[0]);

		// Declare the schema namespace.
		$schema = Config::get('pandaac::schema', 'otserv');
		$class  = "Schema\\{$schema}\\{$object}";


		// Call the class (with or without arguments).
		switch (count($arguments))
		{
			case 0:
				return new $class();

			case 1:
				return new $class($arguments[1]);

			case 2:
				return new $class($arguments[1], $arguments[2]);

			case 3:
				return new $class($arguments[1], $arguments[2], $arguments[3]);

			case 4:
				return new $class($arguments[1], $arguments[2], $arguments[3], $arguments[4]);

			case 5:
				return new $class($arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5]);

			default:
				$reflection = new \ReflectionClass($class);
				return $reflection->newInstanceArgs($arguments);
		}
	}
}