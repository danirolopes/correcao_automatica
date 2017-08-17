<?php

class Resposta extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->ifNotSignedInGoSignIn();

		if(!$this->isInRole(PROFESSOR))
		{
			Controller::redirect(URL.'index');
		}
	}

	function dashboard($id_tarefa)
	{
		$this->view->item_atual = $this->model->item_atual($id_tarefa);

		if(!$this->view->item_atual)
		{
			$this->model->tarefaCorrigida($id_tarefa);
			Controller::redirect(URL.'resposta/index');
		}

		$this->view->tarefa_atual= $id_tarefa;
		$this->view->tabela_feedback = $this->model->getFeedback($id_tarefa);

		$this->view->header = $this->makeHeader('resposta');

		$this->view->render('resposta/dashboard');
	}
	
	function submit($id_tarefa)
	{
		$this->model->refreshTarefa($id_tarefa);		
	}

	function index()
	{
		$this->view->tabela_tarefas = $this->model->getTarefas();

		$this->view->header = $this->makeHeader('resposta');

		$this->view->render('resposta/index');
	}

	function logout()
	{
		Session::destroy();
		Controller::redirect(LOGIN_LINK);
		exit;
	}
}

?>