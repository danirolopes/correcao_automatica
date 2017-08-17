<?php

class Tarefa extends Controller
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

	function index()
	{
		$this->view->message = Session::message();
		$this->view->turmas = $this->model->getTurmas();

		if(isset($_POST['form-submitted'])){


            $cropData = array('x' => $_POST['xCanvas'], 'y' => $_POST['yCanvas'], 'height' => $_POST['heightCanvas'], 'width' => $_POST['widthCanvas']);

            $this->array['pictureAdded'] = isset($_FILES['picture']);


            if($this->array['pictureAdded']){
            	$imageName = $this->model->getImageName();

            	$this->model->run($imageName);


                $this->array['successful'] = $this->saveUpload('picture', 'images/pergunta',$imageName, true, 800, $cropData);

            }else{
                $this->array['successful'] = false;
            }
        }

		$this->view->header = $this->makeHeader('tarefa');
		$this->view->render('tarefa/index');
	}

}

?>