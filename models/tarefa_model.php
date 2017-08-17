<?php

class Tarefa_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function run($imageName)
	{
		$sth = $this->db->prepare("INSERT INTO tarefas (name, postedby, prazo, target, img) VALUES (:name, :postedby, :prazo, :target, :img)");

		$sth->execute(array(':name' => $_POST['name'],
		 ':postedby' => Session::get('id'),
		 ':prazo' => $_POST['prazo'],
		 ':target' => $_POST['turma'],
		 ':img' => $imageName));

		Session::set('message', 'Tarefa enviada com sucesso');
	}

	public function getImageName()
	{
		$sth = $this->db->prepare("SELECT Atual FROM db_variables WHERE Variavel = :variavel");
		$sth->execute(array(':variavel' => 'tarefa'));

		$resposta = $sth->fetch();
		$atual = $resposta['Atual'];

		$sth = $this->db->prepare("UPDATE db_variables SET Atual = :atual WHERE Variavel = :variavel");
		$sth->execute(array(':variavel' => 'tarefa', ':atual' => $atual+1));

		return $atual;
	}

	public function getTurmas()
	{

		$sth = $this->db->prepare("SELECT id, nome FROM turma WHERE (created_by = :id_professor AND role = 1) OR role = 0");
		$sth->execute(array(':id_professor' => Session::get('id')));

		$vetor = $sth->fetchAll();

		return $vetor;
	}
}

?>