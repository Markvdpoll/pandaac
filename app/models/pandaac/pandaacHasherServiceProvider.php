<?php namespace pandaac;

use Illuminate\Support\ServiceProvider;

class pandaacHasherServiceProvider extends ServiceProvider
{
	/**
	**/
	public function register()
	{
		$this->app->bind('hash', function()
		{
			return new pandaacHasher;
		});
	}
}