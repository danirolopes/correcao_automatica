<?php

class Confirm extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->ifNotSignedInGoSignIn();

		if(!$this->isInRole(ADMIN))
		{
			Controller::redirect(URL.'index');
		}
	}

	function index()
	{
		$this->view->message = Session::message();
		$this->view->professores = $this->model->getProfessores();

		$this->view->header = $this->makeHeader('confirm');
		$this->view->render('confirm/index');
	}

	function run()
	{
		$this->model->run();
	}

}

?>