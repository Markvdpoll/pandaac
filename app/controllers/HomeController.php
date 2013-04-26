<?php

class HomeController extends BaseController
{
	/**
	 * Construct the Home controller.
	 *
	 * @access public
	 * @return void
	**/
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * The default landing page for the Home controller.
	 *
	 * @access public
	 * @return View
	**/
	public function index()
	{
		$this->layout->nest('content', 'home.index');
	}
}