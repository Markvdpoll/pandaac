<?php

class BaseController extends Controller
{
	/**
	 * Constructs the base controller.
	 *
	 * @access public
	 * @return void
	**/
	public function __construct()
	{
		// Protect against CSRF attacks.
		$this->beforeFilter('csrf', array('on' => 'post'));
	}


	/**
	 * Setup the layout used by the controller.
	 *
	 * @access protected
	 * @return void
	**/
	protected function setupLayout()
	{
		$this->layout = View::make(Config::get('pandaac::theme.name'));
	}


	/**
	 * Sets the main title for a page.
	 *
	 * @param  string $title
	 * @param  boolean $overrideGroup false
	 * @access protected
	 * @return void
	**/
	protected function title($title, $overrideGroup = false)
	{
		// Fetch a language line, if specified.
		if (substr(strtolower($title), 0, 6) == 'lang::')
		{
			$title = Lang::get(preg_replace('/^lang::/i', null, $title));
		}

		// Override the group title.
		if ( ! empty($overrideGroup))
		{
			static::groupTitle('');
		}

		// Bind the title to the IoC container.
		App::bind('themeTitle', function() use ($title)
		{
			return $title;
		});
	}


	/**
	 * Sets the group title for a page.
	 *
	 * @param  string $title
	 * @access protected
	 * @return void
	**/
	protected function groupTitle($title)
	{
		// Fetch a language line, if specified.
		if (substr(strtolower($title), 0, 6) == 'lang::')
		{
			$title = Lang::get(preg_replace('/^lang::/i', null, $title));
		}

		// Bind the title to the IoC container.
		App::bind('themeGroupTitle', function() use ($title)
		{
			return $title;
		});
	}
}