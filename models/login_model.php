<?php

class Login_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	public function run()
	{
		$sth = $this->db->prepare("SELECT id, role, nome, confirmed FROM user WHERE username = :username AND password = :password");
		$sth->execute(array(':username' => $_POST['username'], ':password' => md5($_POST['password'])));


		$count = $sth->rowCount();

		if($count > 0)
		{
			$vetor = $sth->fetch();

			Session::set('id', $vetor['id']);
			Session::set('role', $vetor['role']);
			Session::set('nome', $vetor['nome']);
			Session::set('confirmed', $vetor['confirmed']);

			Session::set('loggedIn', true);
			Model::redirect(INDEX_LINK);
		}
		else
		{
		    Session::set('message', 'Login e/ou senha inválidos');
		    Model::redirect(LOGIN_LINK);
		}

	}
}

?>