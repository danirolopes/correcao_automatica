<?php

abstract class Controller
{
	
	function __construct()
	{
		$this->view = new View();
	}

	public function loadModel($name)
	{
		$path = 'models/'.$name.'_model.php';

		if(file_exists($path))
		{
			require $path;

			$modelName = $name.'_Model';
			$this->model = new $modelName();
		}
	}

    public function makeHeader($pageName)
    {
        $vetor = array();
        switch ($pageName) {
            case 'index':
                $vetor['sidebar'] = 0;
                break;
            
            case 'tarefa':
                $vetor['sidebar'] = 1;
                break;

            case 'resposta':
                $vetor['sidebar'] = 2;
                break;

            case 'turma':
                $vetor['sidebar'] = 3;
                break;

            case 'confirm':
                $vetor['sidebar'] = 4;
                break;
            case 'enviarAluno':
                $vetor['sidebar'] = 5;
                break;
        }

        $titulo = WEBSITE_NAME;

        switch ($pageName) {
            case 'index':
                $titulo = $titulo.' - Home';
                break;
            
            case 'tarefa':
                $titulo = $titulo.' - Criar Tarefa';
                break;

            case 'resposta':
                $titulo = $titulo.' - Corrigir Tarefas';
                break;

            case 'turma':
                $titulo = $titulo.' - Gerenciar Turmas';
                break;

            case 'login':
                $titulo = $titulo.' - Login';
                break;

            case 'signup':
                $titulo = $titulo.' - Cadastro';
                break;

            case 'confirm':
                $titulo = $titulo.' - Confirmar Professores';
                break;

            case 'enviarAluno':
                $titulo = $titulo.' - Enviar Tarefa';
                break;
                
                default:
            $titulo = $titulo.' - '.$pageName;
        }

        $vetor['title'] = $titulo;

        return $vetor;
    }

	protected function writeLog($message){        
        file_put_contents('logs/pdo_errors_log.txt', date('m/d/Y h:i:s a', time())." - ".$message."\n", FILE_APPEND);
    }
    
    protected function redirect($location) {
        header('Location: '.$location);
    }

    protected function ifSignedInGoHome(){
    	Session::init();
        if(Session::get('loggedIn') == true){
            Controller::redirect(INDEX_LINK);
        }
    }

    protected function ifNotSignedInGoSignIn(){
    	Session::init();
        if(Session::get('loggedIn')==false){
        	Session::destroy();
            Controller::redirect(LOGIN_LINK);
        }
    }

    protected function isInRole($role)
    {
        if($role == PROFESSOR)
        {
            if(Session::get('role') == PROFESSOR)
            {
                if(Session::get('confirmed') == true)
                {
                    return true;
                }
                return false;
            }
        }
        
        if(Session::get('role') == $role)
        {
            return true;
        }
        return false;
    }

	protected function monthToPortuguese($str){
        $str = str_replace('January', 'Janeiro', $str);
        $str = str_replace('February', 'Fevereiro', $str);
        $str = str_replace('March', 'Março', $str);
        $str = str_replace('April', 'Abril', $str);
        $str = str_replace('May', 'Maio', $str);
        $str = str_replace('June', 'Junho', $str);
        $str = str_replace('July', 'Julho', $str);
        $str = str_replace('August', 'Agosto', $str);
        $str = str_replace('September', 'Setembro', $str);
        $str = str_replace('October', 'Outubro', $str);
        $str = str_replace('November', 'Novembro', $str);
        $str = str_replace('December', 'Dezembro', $str);

        return $str;
    }

    protected function monthToEnglish($str){
        $str = str_replace('Janeiro', 'January', $str);
        $str = str_replace('Fevereiro', 'February', $str);
        $str = str_replace('Março', 'March', $str);
        $str = str_replace('Abril', 'April', $str);
        $str = str_replace('Maio', 'May', $str);
        $str = str_replace('Junho', 'June', $str);
        $str = str_replace('Julho', 'July', $str);
        $str = str_replace('Agosto', 'August', $str);
        $str = str_replace('Setembro', 'September', $str);
        $str = str_replace('Outubro', 'October', $str);
        $str = str_replace('Novembro', 'November', $str);
        $str = str_replace('Dezembro', 'December', $str);

        return $str;
    }


    protected function saveUpload($filePostName = '', $directory = '', $renameTo, $resize, $resizeTo = 0, $cropData){
        require_once 'libs/upload/class.upload.php';


        $foo = new Upload($_FILES[$filePostName]); 
        if ($foo->uploaded) {

            $top = $cropData['y'];
            $right = $foo->image_src_x - $cropData['x'] - $cropData['width'];
            $bottom = $foo->image_src_y - $cropData['y'] - $cropData['height'];
            $left = $cropData['x'];

            $foo->file_new_name_body = $renameTo;
            $foo->image_resize = $resize;
            $foo->image_convert = 'jpg';
            $foo->image_x = $resizeTo;
            $foo->image_ratio_y = true;
            $foo->image_precrop = array($top, $right, $bottom, $left);
            $foo->file_overwrite = true;
            $foo->Process($directory);

            if ($foo->processed) {
                return true;
                $foo->Clean();
            } else {
                return false;
            } 
        }else{
            return false;
        }
    }
    protected function printJson($array = null){

        $json = array();

        if($array){
            if(is_array($array)){
                foreach($array as $item){
                    if(is_object($item)){
                        $json[] = $item->toArray();
                    }
                }
            }else{
                $json = $array->toArray();
            }
        }

        $this->array = array_merge($this->array, $json);

        header_remove();
        header('Content-Type: application/json');

        echo json_encode($this->array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

        exit();
    }


}

?>