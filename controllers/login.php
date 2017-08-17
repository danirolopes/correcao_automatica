<?php


class Login extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->ifSignedInGoHome();
	}

	function index()
	{
		$this->view->message = Session::message();
		
		$this->view->header = $this->makeHeader('login');
		$this->view->render('login/index', true);
	}

	function run()
	{
		$this->model->run();
	}
}

?>