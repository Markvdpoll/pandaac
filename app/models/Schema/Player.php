<?php namespace Schema;

class Player extends \Eloquent
{
	protected $table   = 'players';
	
	public $timestamps = false;


	/**
	 * Many to one relationship with accounts.
	 *
	 * @access public
	 * @return instance
	**/
	public function account()
	{
		return $this->hasOne('Schema\\'.\Config::get('pandaac::schema').'\Account');
	}
}