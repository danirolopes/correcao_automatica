

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Nova Tarefa
            </h1>
        </div>
    </div>

	<div class="row">
        <form id="profile-picture-change-form" enctype="multipart/form-data" action="<?php echo URL;?>tarefa" method="POST">
			<div class="col-lg-4">
                <br/>
                <br/>
                <br/>
			    <div class="form-group">
                    <label>Digite o nome da tarefa</label>
                    <input class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Digite o prazo da tarefa</label>
                    <input type="datetime-local" class="form-control" name="prazo">
                </div>
                <div class="form-group">
                    <label>Selecione a turma</label>
                    <select class="form-control" name="turma">
                        <?php 
                        foreach ($this->turmas as $obj)
                        {
                             echo '<option value="'.$obj['id'].'">'.$obj['nome'].'</option>';
                        }
                        ?>                       
                    </select>
                </div>
                <!--<div class="form-group">
                    <label>Tipo de resposta</label>
                    <input class="form-control">
                </div>-->
                <!--<div class="form-group">
                    <label>Resposta certa</label>
                    <input class="form-control">
                </div>-->
                <div class="col-xs-4 col-xs-offset-4" style="margin-top: 40px;">
                    <button type="submit" name="submit" class="btn btn-primary full-width">Salvar</button>
                </div>
			</div>
            <div class="col-lg-8">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2" style="background: white; padding: 30px; border-radius: 10px; margin-top: 15px;">

                    <div class="row">
                        <div class="image-crop">
                            <img src="">
                        </div>
                    </div>



                    <input type="hidden" name="form-submitted" value="" />
                    <input type="hidden" name="xCanvas" value="" />
                    <input type="hidden" name="yCanvas" value="" />
                    <input type="hidden" name="heightCanvas" value="" />
                    <input type="hidden" name="widthCanvas" value="" />

                    <div class="row text-center"  style="margin-top: 40px;">
                        <div class="col-xs-5 col-xs-offset-4 text-center btn-group">
                            <label title="Carregar Foto" for="inputImage" class="btn btn-primary">
                                <input type="file" accept="image/*" name="picture" id="inputImage" class="hide" />
                                Escolher Tarefa
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
		</form>
	</div>
</div>

                