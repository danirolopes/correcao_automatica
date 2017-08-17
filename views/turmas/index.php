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

	<div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>Criar Turma</h3>
                </div>
                <div class="panel-body">
                	<form action = "<?php echo URL;?>turmas/run" method="post">
                    	<div class="form-group">
							<label>Insira o nome da nova turma: </label>
							<input type="text" class="form-control" name="nome"/>
						</div>
						<div class="text-center">
						<button type="submit" class="btn btn-primary full-width">Criar</button>
						</div>
					</form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i>Deletar turma</h3>
                </div>
                <div class="panel-body">
                    <form action = "<?php echo URL;?>turmas/delete" method="post">
						<label>Selecione a turma a ser deletada: </label>
						<div class="form-group">
							<select class="form-control" name="deletar">
								<?php
								foreach($this->turmas as $obj)
								{
									echo '<option value="'.$obj['id'].'">'.$obj['nome'].'</option>';
								}
								?>
							</select>
						</div>
						<br />
						<br/>
						<div class="text-center">
						<button type="submit" class="btn btn-primary full-width">Deletar</button>
						</div>
					</form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Editar Turma</h3>
                </div>
                <div class="panel-body">
                    <form action = "<?php echo URL;?>turmas/editar" method="post">
						<label>Selecione a turma a ser editada: </label>
						<div class="form-group">
							<select class="form-control" name="editar">
								<?php
								foreach($this->turmas as $obj)
								{
									echo '<option value="'.$obj['id'].'">'.$obj['nome'].'</option>';
								}
								?>
							</select>
						</div>
						<br />
						<br/>
						<div class="text-center">
						<button type="submit" class="btn btn-primary full-width">Editar</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
