<?php

class Turmas_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function run()
	{
		$sth = $this->db->prepare("INSERT INTO turma (nome, created_by, role) VALUES (:name, :postedby, :role)");

		$sth->execute(array(':name' => $_POST['nome'],
			':postedby' => Session::get('id'),
			':role' => Session::get('role')));

		Session::set('message', 'Turma criada com sucesso');
		Model::redirect(URL.'turmas');
	}

	public function delete()
	{
		$sth = $this->db->prepare("DELETE FROM turma WHERE id = :id");

		$sth->execute(array(':id' => $_POST['deletar']));

		Session::set('message', 'Turma excluida da database');
		Model::redirect(URL.'turmas');
	}

	public function getTurmas($role)
	{
		if($role == ADMIN)
		{
			$sth = $this->db->prepare("SELECT id, nome FROM turma WHERE role = :role");
			$sth->execute(array(':role' => 0));

			$vetor = $sth->fetchAll();
		}
		if($role == PROFESSOR)
		{	
			// id turma que professor pode mandar tarefa
			$sth = $this->db->prepare("SELECT id, nome FROM turma WHERE created_by = :id_professor AND role = :role");
			$sth->execute(array(':id_professor' => Session::get('id'), ':role' => 1));

			$vetor = $sth->fetchAll();
		}
		if($role == ALUNO)
		{
			$sth = $this->db->prepare("SELECT turma_id FROM turma_relation WHERE aluno_id = :aluno_id ");
			$sth->execute(array(':aluno_id' => Session::get('id')));

			$aux = $sth->fetchAll();

			$vetor = array();
			foreach ($aux as $obj) 
			{
				$sth = $this->db->prepare("SELECT id, nome FROM turma WHERE id = :id");
				$sth->execute(array(':id' => $obj['turma_id']));

				$vetor[] = $sth->fetch();
			}
		}

		return $vetor;

	}


	public function alunos($idTurma)
	{
		// alunos que pertencem a turma
		$sth = $this->db->prepare("SELECT aluno_id FROM turma_relation WHERE turma_id = :turma_id ");
		$sth->execute(array(':turma_id' => $idTurma));

		$vetor = $sth->fetchAll();
		$naTurma = array();
		foreach ($vetor as $obj) {
			$naTurma[$obj['aluno_id']] = true;
		}

		// todos os alunos
		$sth = $this->db->prepare("SELECT nome, id FROM user WHERE role = :role");
		$sth->execute(array(':role' => ALUNO));

		$alunos = $sth->fetchAll();

		foreach ($alunos as $index => $obj) {
			if(isset($naTurma[$obj['id']]))
			{
				$alunos[$index]['naTurma'] = true;
			}
			else
			{
				$alunos[$index]['naTurma'] = false;
			}
		}

		return $alunos;
	}

	public function adicionaAluno($idAluno, $idTurma)//adiciona o aluno escolhido na turma escolhida
	{
		$sth = $this->db->prepare("INSERT INTO turma_relation (turma_id, aluno_id) VALUES (:turma_id, :aluno_id)");

		$sth->execute(array(':turma_id' => $idTurma,
		 ':aluno_id' => $idAluno));
	}

	public function deleteAluno($idAluno, $idTurma)
	{
		$sth = $this->db->prepare("DELETE FROM turma_relation WHERE turma_id = :turma_id AND aluno_id = :aluno_id");

		$sth->execute(array(':turma_id' => $idTurma,
		 ':aluno_id' => $idAluno));

		Session::set('message', 'Aluno deletado com sucesso');
		//Model::redirect(URL.'turmas');
	}
}

?>