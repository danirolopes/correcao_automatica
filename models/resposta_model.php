<?php

class Resposta_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function getTarefas()
	{
		$sth = $this->db->prepare("SELECT name, prazo, id, corrigida FROM tarefas WHERE postedby = :postedby");
		$sth->execute(array(':postedby' => Session::get('id')));
		$tabela_tarefas = $sth->fetchAll();
		return $tabela_tarefas;
	}
	public function getFeedback($id_tarefa)
	{
		$sth = $this->db->prepare("SELECT message,id FROM feedback WHERE createdby = :createdby");
		$sth->execute(array(':createdby' => $id_tarefa));
		$tabela_feedback = $sth->fetchAll();
		return $tabela_feedback;
	}
	public function item_atual($id_tarefa)
	{
		$sth = $this->db->prepare("SELECT * FROM respostas WHERE tarefa_id = :tarefa_id AND corrigida = :corrigida");
		$sth->execute(array(':tarefa_id' => $id_tarefa, ':corrigida' =>0));

		if ($sth->rowCount() == 0)
			return false;

		$vetor = $sth->fetchAll();
		$item = $vetor[0];

		$sth = $this->db->prepare("SELECT nome FROM user WHERE id = :aluno_id");
		$sth->execute(array(':aluno_id' => $item['aluno_id']));

		$aux = $sth->fetch();
		$item['nomeAluno'] = $aux['nome'];
		
		return $item;
	}
	public function refreshTarefa($id_tarefa)
	{
		if(isset($_POST['id_feedback']))
		{
			$sth = $this->db->prepare("UPDATE respostas SET feedback=:feedback, corrigida=:corrigida WHERE id=:id");
			$sth->execute(array(':feedback' => $_POST['id_feedback'],':corrigida' => 1,':id'=>$_POST['id_resposta']));
		}
		else
		{
			$sth = $this->db->prepare("INSERT INTO feedback (createdby, title, message) VALUES (:createdby, :title, :message)");
			$sth->execute(array(':createdby' => $id_tarefa,':title' => "NotDefined", ':message' => $_POST['message']));

			$sth = $this->db->prepare("SELECT id FROM feedback WHERE message = :message AND createdby = :createdby");
			$sth->execute(array(':message' =>$_POST['message'], ':createdby' => $id_tarefa));
			$vetor = $sth->fetch();

			$sth = $this->db->prepare("UPDATE respostas SET feedback = :feedback, corrigida = :corrigida WHERE id = :id");
			$sth->execute(array(':feedback' => $vetor['id'],':corrigida' => 1,':id'=>$_POST['id_resposta']));
		}
		Model::redirect(URL.'resposta/dashboard/'.$id_tarefa);
	}

	public function tarefaCorrigida($id_tarefa)
	{
		$sth = $this->db->prepare("UPDATE tarefas SET corrigida=:corrigida WHERE id=:id");
		$sth->execute(array(':corrigida' => 1,':id'=>$id_tarefa));
	}

}

?>