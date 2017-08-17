<?php

class SignUp_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	public function run()
	{
		$sth = $this->db->prepare("SELECT id FROM user WHERE username = :username");
		$sth->execute(array(':username' => $_POST['username']));


		$count = $sth->rowCount();

		if($count > 0)
		{
			Session::set('message', 'Usuário já utilizado');
		    Model::redirect(SIGNUP_LINK);
		}

		else
		{
		    $sth = $this->db->prepare("INSERT INTO user (username, password, nome, apelido, role) VALUES (:username, :password, :nome, :apelido, :role)");
			$sth->execute(array(':username' => $_POST['username'], 
			':password' => md5($_POST['password']), 
			':nome' => $_POST['nome'].' '.$_POST['lastName'], 
			':apelido' => $_POST['nome'], 
			':role' => $_POST['role']));

			Session::set('message', 'Cadastro realizado com sucesso!');
		    Model::redirect(LOGIN_LINK);
		}
	}
}

?>