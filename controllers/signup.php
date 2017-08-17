<?php


class SignUp extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->ifSignedInGoHome();
	}

	function index()
	{
		$this->view->message = Session::message();
		
		$this->view->header = $this->makeHeader('signup');
		$this->view->render('signup/index', true);
	}

	function run()
	{
		$this->model->run();
	}
}

?>