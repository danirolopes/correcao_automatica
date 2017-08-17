<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Enviar Tarefa
            </h1>
        </div>
    </div>
    
    <div class="row text-center">
        <div class="col-lg-6">
            <h3>Enunciado</h3>
            <div class="img-container">
                <img class="img-responsive" style="margin: 10px auto;" src="<?php echo URL;?>images/pergunta/<?php echo $this->imgId; ?>.jpg" />
            </div>
        </div>
        <div class="col-lg-6">
            <?php if($this->corrigida != 1) {?>
            <h3>Escolher Resposta</h3>
            <form id="profile-picture-change-form" enctype="multipart/form-data" action="<?php echo URL;?>enviarAluno" method="POST">
                <div style="background: white; padding: 30px; border-radius: 10px; margin-top: 15px;">

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
                    <input type="hidden" name="tarefa" value="<?php echo $this->tarefa;?>" />


                    <div class="row text-center"  style="margin-top: 40px;">
                        <div class="text-center btn-group">
                            <label title="Carregar Foto" for="inputImage" class="btn btn-primary">
                                <input type="file" accept="image/*" name="picture" id="inputImage" class="hide" />   Escolher Resposta
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4 col-xs-offset-4" style="margin-top: 40px;">
                        <button type="submit"  class="btn btn-primary full-width">Salvar</button>
                    </div>
                </div>
            </form>
            <?php } else { ?>   
            <h3>Resposta</h3>
                <div style="background: white; padding: 30px; border-radius: 10px; margin-top: 15px;">

                    <div class="row">
                        <div class="img-container">
                            <img class="img-responsive"  style="margin: 0 auto;" src="<?php echo URL;;?>images/resposta/<?php echo $this->resposta['img'];?>.jpg">
                        </div>
                    </div>

                    <div class="row"  style="margin-top: 40px;">
                        <div class="col-lg-offset-2 col-lg-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Feedback</h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo $this->resposta['feedback']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-xs-offset-4" style="margin-top: 40px;">
                        <a href="<?php echo URL;?>/enviarAluno/index"><button class="btn btn-primary full-width">Voltar</button></a>
                    </div>
                </div>
            <?php } ?>         
        </div>
    </div>
    
</div>


 