<?php

class enviarAluno_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function getTarefas()
	{
		$sth = $this->db->prepare("SELECT turma_id FROM turma_relation WHERE aluno_id = :aluno_id");
		$sth->execute(array(':aluno_id' => Session::get('id')));
		$vetorTurmas = $sth->fetchAll();

		$vetorTarefas = array();
		foreach ($vetorTurmas as $obj) 
		{
			$sth = $this->db->prepare("SELECT name, prazo, postedby, id FROM tarefas WHERE target = :turma_id");
			$sth->execute(array(':turma_id' => $obj['turma_id']));
			$aux = $sth->fetchAll();
			$vetorTarefas = array_merge($vetorTarefas, $aux);
		}

		foreach ($vetorTarefas as $index => $obj) 
		{
			$sth = $this->db->prepare("SELECT corrigida FROM respostas WHERE tarefa_id = :tarefa_id AND aluno_id = :aluno_id");
			$sth->execute(array(':tarefa_id' => $obj['id'], ':aluno_id' => Session::get('id')));

			if($sth->rowCount() == 0)
			{
				$vetorTarefas[$index]['corrigida'] = -1;
			}
			else
			{
				$corrigida = $sth->fetch();
				$vetorTarefas[$index]['corrigida'] = $corrigida['corrigida'];
			}
		}

		foreach ($vetorTarefas as $index => $obj) 
		{
			$sth = $this->db->prepare("SELECT nome FROM user WHERE id = :professor_id");
			$sth->execute(array(':professor_id' => $obj['postedby']));
			$professorName = $sth->fetch();

			$vetorTarefas[$index]['nomeProfessor'] = $professorName['nome'];
		}

		return $vetorTarefas;
	}

	public function getTarefa($tarefa_id)
	{
		$sth = $this->db->prepare("SELECT img FROM tarefas WHERE id = :tarefa_id");
		$sth->execute(array(':tarefa_id' => $tarefa_id));

		$resposta = $sth->fetch();

		return $resposta['img'];
	}

	public function run($imageName)
	{
		$sth = $this->db->prepare("SELECT id FROM respostas WHERE tarefa_id = :tarefa_id AND aluno_id = :aluno_id)");

		$sth->execute(array(':tarefa_id' => $_POST['tarefa'],
		 ':aluno_id' => Session::get('id')));

		if($sth->rowCount() == 0)
		{
			$sth = $this->db->prepare("INSERT INTO respostas (tarefa_id, aluno_id, img) VALUES (:tarefa_id, :aluno_id, :img)");

			$sth->execute(array(':tarefa_id' => $_POST['tarefa'],
			 ':aluno_id' => Session::get('id'),
			 ':img' => $imageName));

			Session::set('message', 'Tarefa enviada com sucesso');
		}
		else
		{
			$aux = $sth->fetch();
			$sth = $this->db->prepare("UPDATE respostas SET img = :img WHERE id = :id");

			$sth->execute(array(':id' => $aux['id'],
			 ':img' => $imageName));

			Session::set('message', 'Tarefa reenviada com sucesso');
		}
	}

	public function getImageName()
	{
		$sth = $this->db->prepare("SELECT Atual FROM db_variables WHERE Variavel = :variavel");
		$sth->execute(array(':variavel' => 'resposta'));

		$resposta = $sth->fetch();
		$atual = $resposta['Atual'];

		$sth = $this->db->prepare("UPDATE db_variables SET Atual = :atual WHERE Variavel = :variavel");
		$sth->execute(array(':variavel' => 'resposta', ':atual' => $atual+1));

		return $atual;
	}

	public function getResposta($tarefa_id)
	{
		$sth = $this->db->prepare("SELECT img, feedback FROM respostas WHERE tarefa_id = :tarefa_id AND aluno_id = :aluno_id");
		$sth->execute(array(':tarefa_id' => $tarefa_id, ':aluno_id' => Session::get('id')));
		$resultado = $sth->fetch();

		$sth = $this->db->prepare("SELECT message FROM feedback WHERE id = :id");
		$sth->execute(array(':id' => $resultado['feedback']));
		$aux = $sth->fetch();
		$resultado['feedback'] = $aux['message'];

		return $resultado;
	}

}

?>