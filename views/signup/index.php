<body>
<div class="page-wrapper login-page">
		<?php if (isset($this->message))
		{
			echo $this->message;
		}?>

		<div class="middle-box text-center loginscreen animated fadeInDown">
		    <div>
		        <div>
		            <h1 class="logo-name">HUM-61</h1>
		        </div>

		        <h3>Cadastro</h3>

		        <form role="form" action="<?php echo URL?>signup/run" method="post">
					
					<div class="form-group loginColumns">
		                <input type="text" name="nome" class="form-control" placeholder="Nome" required="">
		            </div>

		            <div class="form-group loginColumns">
		                <input type="text" name="lastName" class="form-control" placeholder="Sobrenome" required="">
		            </div>	

		            <div class="form-group loginColumns">
		                <input type="text" name="username" class="form-control" placeholder="Nome de usuário" required="">
		            </div>
		            
		            <div class="form-group loginColumns">
		                <input type="password" name="password" class="form-control" placeholder="Senha" required="">
		            </div>
					
		            <div class="form-group loginColumns">
		                <select class="form-control" name="role">
		                	<option value="2">Aluno</option>
		                	<option value="1">Professor</option>
		                </select>
		            </div>

		            <button type="submit" class="btn btn-primary" style="width: 60%;">Cadastrar</button>
		            <br/>   <br/> 

		            <p class="text-muted text-center"><small>Já tem conta?</small></p>
		            <a class="btn  btn-default" style="width: 60%;" href="<?php echo LOGIN_LINK;?>">Faça Login</a>
		        </form>
		    </div>
		</div>