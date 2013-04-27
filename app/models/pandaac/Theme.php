<?php namespace pandaac;

class Theme
{
	/**
	 * Returns the theme name.
	 *
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function name()
	{
		return \Config::get('pandaac::theme.name');
	}


	/**
	 * Returns the title in a specific format.
	 *
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function title()
	{
		// Try to get the title & group title.
		try
		{
			$title      = \App::make('themeTitle');
			$groupTitle = \App::make('themeGroupTitle');
		}
		catch (\Exception $e) { }


		// Get the server name.
		$serverName = \Server::name();

		// If both title & group title are set.
		if ( ! empty($title) and ! empty($groupTitle))
		{
			return $title.' &#124; '.$groupTitle.' &mdash; '.$serverName;
		}

		// If only title is set.
		if ( ! empty($title) and empty($groupTitle))
		{
			return $title.' &mdash; '.$serverName;
		}

		// If only group title is set.
		if ( ! empty($groupTitle) and empty($title))
		{
			return $groupTitle.' &mdash; '.$serverName;
		}

		return $serverName;
	}


	/**
	 * Returns the breadcrumbs.
	 *
	 * @param  string $additional false
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function breadcrumbs($additional = false)
	{
		$output = null;

		// Get the current route action.
		$currentRoute = \Route::currentRouteAction();
		$routePieces  = explode('@', $currentRoute);

		// Get the controller and the method.
		$controller = isset($routePieces[0]) ? $routePieces[0] : '404';
		$method     = isset($routePieces[1]) ? $routePieces[1] : '404';

		// Get the title path.
		$titlePath = str_replace(':theme', static::name(), \Config::get('pandaac::theme.titlePath'));


		// Format the controller.
		$controller = strtolower(preg_replace('/Controller$/i', null, $controller));
		// Check if the controller exists as an image.
		if ( ! empty($controller) and \File::exists($titlePath.$controller.'/index.png'))
		{
			$output .= '<li><img src="'.static::asset($titlePath.$controller.'/index.png', true).'" alt="'.$controller.'"></li>';
		}


		// Format the method.
		$method = strtolower($method);
		// Check if the method exists as an image.
		if ($method != 'index' and \File::exists($titlePath.$controller.'/'.$method.'.png'))
		{
			// Add a separator in case a controller was specified.
			if ( ! empty($controller))
			{
				$output .= '<li><img src="'.static::asset($titlePath.'separator.png', true).'" alt="&raquo;"></li>';
			}

			$output .= '<li><img src="'.static::asset($titlePath.$controller.'/'.$method.'.png', true).'" alt="'.$method.'"></li>';
		}


		// Check if any additional titles were added.
		if ( ! empty($additional))
		{
			$output .= '<li><img src="'.static::asset($titlePath.'separator.png', true).'" alt="&raquo;"></li>';
			$output .= $additional;
		}

		return $output;
	}


	/**
	 * Return the current route as a class name.
	 *
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function routeAsClass()
	{
		// Get the current route.
		$route = str_replace('/', '-', strtolower(\Route::currentRouteName()));

		// Remove any HTTP type.
		$route = preg_replace('/(get|post|put|delete) /', null, $route);

		return $route;
	}


	/**
	 * Returns the URL for a specific theme asset.
	 *
	 * @param  string $path
	 * @param  boolean $absolute false
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function asset($path, $absolute = false)
	{
		return \URL::to(( ! $absolute ? 'assets/'.static::name().'/' : null).$path);
	}


	/**
	 * Returns the real path of a theme asset.
	 *
	 * @param  string $path
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function path($path)
	{
		return realpath(public_path().'/assets/'.static::name().'/'.$path);
	}


	/**
	 * Returns the URL for a specific theme image.
	 *
	 * @param  string $path
	 * @param  string $alt null
	 * @param  boolean $absolute = false
	 * @access public
	 * @static true
	 * @return string
	**/
	public static function img($path, $alt = null, $absolute = false)
	{
		// Fetch a language line, if one was requested.
		if (substr(strtolower($alt), 0, 6) == 'lang::')
		{
			$alt = \Lang::get(preg_replace('/^lang::/i', null, $alt));
		}

		return '<img src="'.static::asset('img/'.$path).'" alt="'.$alt.'">';
	}
}