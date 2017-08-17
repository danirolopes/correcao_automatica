<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Correção de Tarefas
            </h1>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Prazo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cont = 0;
                $aux = array_reverse($this->tabela_tarefas);
                foreach ($aux as $obj)
                {
                    if ($cont == 10)
                    {
                        break;
                    }
                    echo '<tr>
                    <td>'.$obj['name'].'</td>
                    <td>'.$obj['prazo'].'</td>
                    <td>';
                    if ($obj['corrigida'] == 0)
                    {
                     echo '<form action = "'.URL.'resposta/dashboard/'.$obj['id'].'" method="post">
                      <button type="submit" class="btn btn-primary">Corrigir tarefa</button>
                     </form>
                    </td>
                    </tr>';
                    }
                    else
                    {
                        echo 'Tarefa Corrigida </td>';
                    }

                    $cont++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>