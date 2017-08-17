<div class="container-fluid">
	<!-- Page Heading -->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            Editar Turmas
	        </h1>
	    </div>
	</div>

<?php if(isset($this->message)){ echo $this->message;}?>

	<div class="row text-center">
		<div class="col-lg-6">
			<h2>Alunos na turma</h2>
			<div class="table-reponsive">
				<form method="post" action="<?php echo URL;?>turmas/deleteAluno">
					<input type="hidden" name="turma" value="<?php echo $this->turma;?>"></input>
					<table class="table table-hover table-striped">
						<thead>
							<td> </td>
							<td>Nome</td>
							<td>Deletar</td>
						</thead>
						<tbody>
						<?php
							foreach ($this->alunos as $obj) 
							{
								if($obj['naTurma'] == true)
								echo '<tr>
									<div class="form-group">
										<td><div class="checkbox">
	                                        <input type="checkbox" name="check_list[]" value="'.$obj['id'].'">
	                                </div></td>
										<td>'.$obj['nome'].'</td>
										<td>
                            				<button type="submit" name="aluno" value="'.$obj['id'].'" class="btn btn-default">Deletar Aluno</button>
										</td>
									</div>
								</tr>';
							}
						?>
						</tbody>
					</table>
					<button type="submit"class="btn btn-primary">Deletar Alunos Selecionados</button>
				</form>
			</div>
		</div>
		<div class="col-lg-6">
			<h2>Alunos que NÃO estão na turma</h2>
			<div class="table-reponsive">
				<form method="post" action="<?php echo URL;?>turmas/adicionaAluno">
					<input type="hidden" name="turma" value="<?php echo $this->turma;?>"></input>
					<table class="table table-hover table-striped">
						<thead>
							<td> </td>
							<td>Nome</td>
							<td>Adicionar</td>
						</thead>
						<tbody>
						<?php
							foreach ($this->alunos as $obj) 
							{
								if($obj['naTurma'] == false)
								echo '<tr>
									<div class="form-group">
										<td><div class="checkbox">
	                                        <input type="checkbox" name="check_list[]" value="'.$obj['id'].'">
	                                </div></td>
										<td>'.$obj['nome'].'</td>
										<td>
                            				<button type="submit" name="aluno" value="'.$obj['id'].'" class="btn btn-default">Adicionar Aluno</button>
										</td>
									</div>
								</tr>';
							}
						?>
						</tbody>
					</table>
					<button type="submit"class="btn btn-primary">Adicionar Alunos Selecionados</button>
				</form>
			</div>
		</div>
	</div>
</div>