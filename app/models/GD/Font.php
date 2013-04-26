<?php namespace GD;

class Font
{
	protected $_font   = null;


	/**
	 * Constructs the GD Font class.
	 *
	 * @param  string $font
	 * @access public
	 * @return void
	**/
	public function __construct($font)
	{
		// Throw an exception in case the specified font couldn't be found.
		if ( ! \File::exists($font))
		{
			throw new Exception('GD Font path <'.$font.'> was invalid');
		}

		// Set the font path.
		$this->_font = $font;

		// Set the GD FONT PATH variable.
		putenv('GDFONTPATH='.dirname($font));
	}


	/**
	 * Returns the relative or absolute path.
	 *
	 * @param  boolean $absolute false
	 * @access public
	 * @return string
	**/
	public function path($absolute = false)
	{
		if ($absolute)
		{
			return $this->_font;
		}

		return basename($this->_font);
	}


	/**
	 * Get the width & height from a text string.
	 *
	 * @param  string $string
	 * @param  integer $size
	 * @param  integer $angle 0
	 * @access public
	 * @return array
	**/
	public function stringLength($string, $size, $angle = 0)
	{
		// Generate an invisible box to retrieve the width and height properties.
		$box = imagettfbbox($size, $angle, $this->_font, $string);

		// Calculate the proper width and height values.
		$width  = abs($box[4] - $box[0]);
		$height = abs($box[5] - $box[1]);

		return [
			0		 => $width,
			'width'	 => $width,

			1		 => $height,
			'height' => $height,
		];
	}


	/**
	 * Generate the text resource.
	 *
	 * @param  resource $image
	 * @param  string $string
	 * @param  integer $size
	 * @param  string $colour #000
	 * @param  integer $x 0
	 * @param  integer $y 0
	 * @param  integer $angle 0
	 * @access public
	 * @return void
	**/
	public function generate(&$image, $string, $size, $colour = '#000', $x = 0, $y = 0, $angle = 0)
	{
		imagettftext($image, $size, $angle, $x, $y, Colour::get($image, $colour), $this->path(), $string);
	}
}