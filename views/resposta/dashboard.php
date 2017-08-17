<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Correção de Tarefas
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="row img-container">
                <img class="img-responsive" style="margin: 10px auto;" src="<?php echo URL;?>images/resposta/<?php echo $this->item_atual['img'];?>.jpg" />
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="col-lg-8 text-center">
                            <br/>
                        <h3><?php echo $this->item_atual['nomeAluno'];?></h3>
                    </div>
                    <div class="col-lg-4">
                        <h3>Enviado em:</h3><br/>
                        <h4><?php echo $this->item_atual['data_envio'];?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><h4>Feedback</h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cont = 0;
                            $aux = array_reverse($this->tabela_feedback);
                            foreach ($aux as $obj)
                            {
                                if ($cont == 10)
                                {
                                    break;
                                }
                                echo '<tr>
                                <td><div class="col-lg-8"><p>'.$obj['message'].'</p></div><div class="col-lg-4"><form action = "'.URL.'resposta/submit/'.$this->tarefa_atual.'" method="post">
                                 <input type="hidden" value='.$obj['id']. ' name="id_feedback" />
                                 <input type="hidden" value='.$this->item_atual['id']. ' name="id_resposta" />
                                <button type="submit"class="btn btn-primary">Enviar</button></div>
                                 </form>
                                </td>
                                </tr>';
                                $cont++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="form-group text-center">
                    <h4>Novo Feedback</h4>
                    <form action="<?php echo URL;?>resposta/submit/<?php echo $this->tarefa_atual; ?>" method="post">
                        <input type="text" class="form-control" name="message"/>
                        <input type="hidden" value=<?php echo $this->tarefa_atual; ?> name="id_tarefa" />
                        <input type="hidden" value=<?php echo $this->item_atual['id'] ?> name="id_resposta" /><br/>
                        <button type="submit"class="btn btn-default">Criar Feedback</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


 