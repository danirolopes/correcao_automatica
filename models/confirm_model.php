<?php

class Confirm_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function run()
	{
		$sth = $this->db->prepare("UPDATE user SET confirmed = 1 WHERE id = :id");

		$sth->execute(array(':id' => $_POST['id']));

		Session::set('message', 'Professor confirmado com sucesso!');

		Model::redirect(URL.'confirm');
	}

	public function getProfessores()
	{
		$sth = $this->db->prepare("SELECT id, nome FROM user WHERE role = :role AND confirmed = :confirmed");
		$sth->execute(array(':role' => PROFESSOR, ':confirmed' => false));

		$vetor = $sth->fetchAll();

		return $vetor;
	}
}

?>