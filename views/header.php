<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo URL;?>index"><?php echo $this->header['title']?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo Session::get('nome'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo URL ?>index/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php if($this->header['sidebar'] == 0){ echo 'class="active"'; }?>>
                        <a href="<?php echo URL;?>index"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                    </li>
                    <?php if($this->isInRole(PROFESSOR)){ ?>
                        <li <?php if($this->header['sidebar'] == 1) {echo 'class="active"';} ?>>
                            <a href="<?php echo URL;?>tarefa"><i class="fa fa-fw fa-bar-chart-o"></i> Criar Tarefa</a>
                        </li>
                        <li <?php if($this->header['sidebar'] == 2) {echo 'class="active"';} ?>>
                            <a href="<?php echo URL;?>resposta"><i class="fa fa-fw fa-table"></i> Corrigir Tarefa</a>
                        </li>
                    <?php } if($this->isInRole(ADMIN) || $this->isInRole(PROFESSOR) || $this->isInRole(ALUNO)){ ?>
                        <li <?php if($this->header['sidebar'] == 3) {echo 'class="active"';} ?>>
                            <a href="<?php echo URL;?>turmas"><i class="fa fa-fw fa-edit"></i> Turmas</a>
                        </li>
                    <?php } if($this->isInRole(ADMIN)){ ?>
                        <li <?php if($this->header['sidebar'] == 4) {echo 'class="active"';} ?>>
                            <a href="<?php echo URL;?>confirm"><i class="fa fa-fw fa-edit"></i> Confirmar Professores</a>
                        </li>
                    <?php } ?>
                    <?php if($this->isInRole(ALUNO)){ ?>
                        <li <?php if($this->header['sidebar'] == 5) {echo 'class="active"';} ?>>
                            <a href="<?php echo URL;?>enviarAluno"><i class="fa fa-fw fa-edit"></i> Enviar Tarefa</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">

