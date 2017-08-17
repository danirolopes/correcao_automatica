<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Enviar Tarefa
            </h1>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Professor</th>
                    <th>Prazo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->tabela_tarefas as $obj)
                {
                    echo '<tr>
                    <td>'.$obj['name'].'</td>
                    <td>'.$obj['nomeProfessor'].'</td>
                    <td>'.$obj['prazo'].'</td>
                    <td>
                     <form action ="'.URL.'enviarAluno/dashboard" method="post">
                        <input type="hidden" name="id_tarefa" value="'.$obj['id'].'"/>
                        <input type="hidden" name="corrigida" value="'.$obj['corrigida'].'"/>                        
                      <button type="submit" class="btn btn-primary">';
                    if($obj['corrigida'] == -1)
                    {
                        echo 'Enviar Tarefa';
                    }
                    if($obj['corrigida'] == 0)
                    {
                        echo 'Reenviar Tarefa';
                    }
                    if($obj['corrigida'] == 1)
                    {
                        echo 'Ver correção';
                    }
                    echo '</button>
                     </form>
                    </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>