<div class="container-fluid">
	<!-- Page Heading -->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            Turmas
	        </h1>
	    </div>
	</div>

<?php if(isset($this->message)){ echo $this->message;}?>

	<div class="row text-center">
		<h2>Turmas que você está inscrito</h2>
		<div class="table-reponsive col-lg-8 col-lg-offset-2">
			<form method="post" action="<?php echo URL;?>turmas/deleteAluno">
				<input type="hidden" name="aluno" value="<?php echo Session::get('id');?>"></input>
				<table class="table table-hover table-striped">
					<thead>
						<td>Nome da Turma</td>
						<td> </td>
					</thead>
					<tbody>
					<?php
						foreach ($this->turmas as $obj) 
						{
							echo '<tr>
									<td>'.$obj['nome'].'</td>
									<td>
                        				<button type="submit" name="turma" value="'.$obj['id'].'" class="btn btn-primary">Sair Turma</button>
									</td>
								</div>
							</tr>';
						}
					?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>