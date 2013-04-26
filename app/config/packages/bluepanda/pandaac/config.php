<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Schema
	|--------------------------------------------------------------------------
	|
	| This option controls what database schema to use. This allows the
	| administrator to easily choose a database schema that is suitable
	| for their OpenTibia server. Valid options may be found as folders
	| within the ./app/models/Schema/ folder.
	|
	| User-submitted and / or pandaac-developed schemas may be found at
	| https://download.pandaac.net/schemas
	|
	*/
	'schema' => 'otserv',


	/*
	|--------------------------------------------------------------------------
	| Theme
	|--------------------------------------------------------------------------
	|
	| This option controls what theme to use.
	|
	| User-submitted and / or pandaac-developed themes may be found at
	| https://download.pandaac.net/themes
	|
	*/
	'theme' => array(

		'name'		 => 'pandaac',
		'titlePath'  => 'assets/:theme/img/cases/titles/',

		'captcha'	 => true,

	),


	/*
	|--------------------------------------------------------------------------
	| Server
	|--------------------------------------------------------------------------
	|
	| This option controls certain server related information.
	|
	*/
	'server' => array(

		'name'	 => 'Ere\'nath',
		'hash'	 => 'plain',

	),

);