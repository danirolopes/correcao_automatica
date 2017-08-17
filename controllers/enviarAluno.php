<?php

class EnviarAluno extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->ifNotSignedInGoSignIn();

		if(!$this->isInRole(ALUNO))
		{
			Controller::redirect(URL.'index');
		}
	}

	function dashboard()
	{
		$this->view->imgId = $this->model->getTarefa($_POST['id_tarefa']);
		$this->view->resposta = $this->model->getResposta($_POST['id_tarefa']);
		$this->view->tarefa = $_POST['id_tarefa'];
		$this->view->corrigida = $_POST['corrigida'];

		$this->view->header = $this->makeHeader('enviarAluno');

		$this->view->render('enviarAluno/dashboard');
	}

	function index()
	{
		$this->view->tabela_tarefas = $this->model->getTarefas();

		if(isset($_POST['form-submitted'])){


            $cropData = array('x' => $_POST['xCanvas'], 'y' => $_POST['yCanvas'], 'height' => $_POST['heightCanvas'], 'width' => $_POST['widthCanvas']);

            $this->array['pictureAdded'] = isset($_FILES['picture']);


            if($this->array['pictureAdded']){
            	$imageName = $this->model->getImageName();

            	$this->model->run($imageName);


                $this->array['successful'] = $this->saveUpload('picture', 'images/resposta',$imageName, true, 800, $cropData);

            }else{
                $this->array['successful'] = false;
            }
        }

		$this->view->header = $this->makeHeader('enviarAluno');

		$this->view->render('enviarAluno/index');
	}

}

?>