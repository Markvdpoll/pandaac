<?php namespace GD;

class Processor
{
	/**
	 * Validates whether the PHP GD extension is active or not.
	 *
	 * @access public
	 * @static true
	 * @return boolean
	**/
	public static function isGDEnabled()
	{
		if ( ! \Config::get('pandaac::theme.captcha') or ! function_exists('gd_info'))
		{
			return false;
		}

		return true;
	}


	/**
	 * Creates an image object.
	 *
	 * @param  integer $width
	 * @param  integer $height
	 * @param  string $background false
	 * @access public
	 * @static true
	 * @return resource
	**/
	public static function create($width, $height, $background = false)
	{
		// Create the image object.
		$image = imagecreatetruecolor($width, $height);

		// Set the background colour, if one was specified.
		if ($background)
		{
			imagefilledrectangle($image, 0, 0, ($width - 1), ($height - 1), Colour::get($image, $background));
		}

		return $image;
	}


	/**
	 * Displays a created image object.
	 *
	 * @param  resource $image
	 * @access public
	 * @static true
	 * @return void
	**/
	public static function display($image)
	{
		// Display & destroy the image object.
		if (ob_get_length() === 0)
		{
			header('Content-Type: image/png');
			imagepng($image);
			imagedestroy($image);
			exit;
		}
	}
}