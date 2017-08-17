<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Confirmar Professores
            </h1>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Confirmar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->professores as $obj)
                {
                    echo '<tr>
                    <td>'.$obj['nome'].'</td>
                    <td>
                     <form action = "'.URL.'confirm/run" method="post">
                      <button type="submit" name="id" value="'.$obj['id'].'" class="btn btn-primary">Confirmar Professor</button>
                     </form>
                    </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>