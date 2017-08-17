<?php

class Error extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->view->header = $this->makeHeader('error');
		$this->view->render('error/index', true);
	}
}

?> 