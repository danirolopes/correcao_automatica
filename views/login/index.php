<body>
<div class="wrapper login-page">
		<?php if (isset($this->message))
		{
			echo $this->message;
		}?>

		<div class="middle-box text-center loginscreen animated fadeInDown">
		    <div>
		        <div>
		            <h1 class="logo-name">HUM-61</h1>
		        </div>

		        <h3>Bem vindo a Plataforma Educacional OpenSource</h3>

		        <p>É recomendado utilizar em um computador. Pode não funcionar corretamente no celular.</p>

		        <form role="form" action="<?php echo URL?>login/run" method="post">

		            <div class="form-group loginColumns">
		                <input type="text" name="username" class="form-control" placeholder="Nome de usuário" required="">
		            </div>
		            
		            <div class="form-group loginColumns">
		                <input type="password" name="password" class="form-control" placeholder="Senha" required="">
		            </div>

		            <button type="submit" class="btn btn-primary" style="width: 60%;">Login</button>
		            <br/>   <br/> 

		            <a href="#"><small>Esqueceu sua senha?</small></a><br/>
		            <p class="text-muted text-center"><small>Não tem uma conta?</small></p>
		            <a class="btn  btn-default" style="width: 60%;" href="<?php echo SIGNUP_LINK;?>">Criar conta</a>
		        </form>
		    </div>
		</div>