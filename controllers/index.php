<?php


class Index extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->ifNotSignedInGoSignIn();
	}

	function index()
	{
		$this->view->header = $this->makeHeader('index');
		$this->view->render('index/index');
	}

	function logout()
	{
		Session::destroy();
		Controller::redirect(LOGIN_LINK);
		exit;
	}
}

?>