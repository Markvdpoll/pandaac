<?php namespace GD;

class Colour
{
	/**
	 * Convert HEX values into RGB arrays.
	 *
	 * @param  string $hex
	 * @access private
	 * @static true
	 * @return array
	**/
	private static function _HEXtoRGB($hex)
	{
		// Remove any non-alphanumerical characters.
		$hex = preg_replace('/([^0-9a-zA-Z]+)/', null, $hex);

		if (strlen($hex) == 3)
		{
			list($r, $g, $b) = [
				hexdec(substr($hex, 0, 1).substr($hex, 0, 1)),
				hexdec(substr($hex, 1, 1).substr($hex, 1, 1)),
				hexdec(substr($hex, 2, 1).substr($hex, 2, 1)),
			];
		}
		else
		{
			list($r, $g, $b) = [
				hexdec(substr($hex, 0, 2)),
				hexdec(substr($hex, 2, 2)),
				hexdec(substr($hex, 4, 2)),
			];
		}

		return [$r, $g, $b];
	}


	/**
	 * Returns the specified HEX colour as an imagecolorallocate integer.
	 *
	 * @param  resource $image
	 * @param  string $colour
	 * @access public
	 * @static true
	 * @return integer
	**/
	public static function get($image, $colour)
	{
		// Get the RGB value of the specified HEX colour.
		$colour = static::_HEXtoRGB($colour);

		return imagecolorallocate($image, $colour[0], $colour[1], $colour[2]);
	}
}