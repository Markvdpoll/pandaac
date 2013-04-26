<?php

class Server
{
	public static function name()
	{
		return Config::get('pandaac::server.name');
	}


	public static function ip()
	{
		return 'faloria.eu';
	}


	public static function port()
	{
		return 7171;
	}


	public static function protocol()
	{
		return '8.60';
	}


	public static function status()
	{
		return rand(0, 1);
	}


	public static function players()
	{
		return rand(0, 100);
	}


	public static function maxPlayers()
	{
		return 100;
	}
}