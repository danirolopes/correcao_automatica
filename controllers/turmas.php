<?php

class Turmas extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->ifNotSignedInGoSignIn();

		$this->view->header = $this->makeHeader('turma');
	}

	function index()//funcao chamada sempre que abre a pagina
	{
		$this->view->message = Session::message();
		
		$this->view->turmas=$this->model->getTurmas(Session::get('role'));

		if($this->isInRole(PROFESSOR)||$this->isInRole(ADMIN))
		{
			$this->view->render('turmas/index');
		}
		else
		{
			$this->view->render('turmas/index_aluno');
		}
	}

	function run()//chama a funcao de criar turma
	{
		$this->model->run();
	}

	function delete()//chama a funcao de deletar turma
	{
		$this->model->delete();
	}

	function editar()//chama a funcao para selecionar os alunos para adicionar na turma escolhida
	{
		if($this->isInRole(ALUNO))
		{
			Controller::redirect(URL.'index');
		}

		$this->view->alunos = $this->model->alunos($_POST['editar']);
		$this->view->turma = $_POST['editar'];
		$this->view->render('turmas/editar');
	}


	function adicionaAluno()//efetivamente adiciona o aluno
	{
		if (isset($_POST['aluno']))
		{
			$this->model->adicionaAluno($_POST['aluno'],$_POST['turma']);
			Session::set('message', 'Aluno adicionado com sucesso!');
		}
		else
		{
			if(!empty($_POST['check_list']))
			{
				foreach ($_POST['check_list'] as $check) {
					$this->model->adicionaAluno($check, $_POST['turma']);
				}
				Session::set('message', 'Alunos adicionados com sucesso!');
			}
		}

		Controller::redirect(URL.'turmas/index');

	}	

	function deleteAluno()//efetivamente deleta o aluno
	{
		if (isset($_POST['aluno']))
		{
			$this->model->deleteAluno($_POST['aluno'],$_POST['turma']);
			if(Session::get('role')!=ALUNO)
			{
				Session::set('message', 'Aluno deletado com sucesso!');
			}
			else
			{
				Session::set('message', 'Saiu da turma com sucesso!');
			}
		}
		else
		{
			if(!empty($_POST['check_list']))
			{
				foreach ($_POST['check_list'] as $check) {
					$this->model->deleteAluno($check, $_POST['turma']);
				}
				Session::set('message', 'Alunos deletados com sucesso!');
			}
		}

		Controller::redirect(URL.'turmas/index');
	}



}

?>