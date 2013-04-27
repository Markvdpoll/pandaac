<?php namespace pandaac;

class pandaacHasher implements \Illuminate\Hashing\HasherInterface
{
	/**
	**/
	public function make($value, array $options = array())
	{
		return \pandaac::password($value);
	}


	/**
	**/
	public function check($value, $hashedValue, array $options = array())
	{
		return \pandaac::password($value) == $hashedValue;
	}


	/**
	**/
	public function needsRehash($value, array $options = array())
	{
		return false;
	}
}