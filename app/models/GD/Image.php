<?php namespace GD;

class Image
{
	protected $_image = null;


	/**
	 * Construct an image object.
	 * 
	 * @param  string $image
	 * @access public
	 * @return void
	**/
	public function __construct($image)
	{
		if ( ! \File::exists($image))
		{	
			throw new Exception('GD Image path <'.$image.'> was invalid');
		}

		$this->_image = $image;
	}
}