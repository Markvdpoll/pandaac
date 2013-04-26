<?php namespace GD\Captcha;

class Image extends \GD\Processor
{
	protected $_font       = null;

	protected $_background = '#000';
	protected $_colours    = ['#98d486', '#6eafe3', '#e27571', '#e7d85d', '#de8fdf'];


	/**
	 * Constructs the captcha object.
	 * 
	 * @param  \GD\Font $font
	 * @access public
	 * @return void
	**/
	public function __construct(\GD\Font $font)
	{
		// Set the font object.
		$this->_font = $font;
	}


	/**
	 * Generate the captcha image.
	 *
	 * @param  integer $size 14
	 * @access public
	 * @return void
	**/
	public function generate($size = 14)
	{
		list($keyphrase, $padding) = [
			substr(md5(uniqid(rand(), true)), 0, 8),
			ceil($size / 4),
		];


		// Get the overall width and height of the specified string.
		list($width, $height) = $this->_font->stringLength($keyphrase, $size);
		// Create the image object.
		$image = parent::create($width + $padding, 17, $this->_background);

		$x = ($padding / 2);
		// Loop through each character in the keyphrase.
		for ($i = 0; $i <= (strlen($keyphrase) - 1); $i++)
		{
			// Get the width and height of the string character.
			list($width, $height) = $this->_font->stringLength($keyphrase[$i], $size);
			// Add the text to the image object.
			$this->_font->generate($image, $keyphrase[$i], $size, $this->_colours[array_rand($this->_colours)], $x, $height + ($height > 13 ? 0 : $padding / 2));

			$x += $width;
		}


		parent::display($image);
	}
}