<?php

	include("conexao/conexao.php");
	 
	// verificando sessão
	include("protect.php");
	protect3();

	if(isset($_GET['usuario'])){
		$usuario['nome'] = $_SESSION['usuario'];
	}else{
		$usuario['nome'] = $_SESSION['nome'];
	}

	// vendo se é o primeiro acesso
	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==0) {

			$sql_code = "UPDATE tuser SET prim_acesso=0 WHERE user_nome='$usuario[nome]'";
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);

			if($confirma){
				$boasvindas[] = "Bem-vindo ao survivor da galera! Você pode trocar a sua senha agora ou a qualquer momento, basta acessar o menu ao lado.";
			}else{
				$erro[]=$confirma;
			}

		}
	}
	

	// Criação da Sessão

	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			session_start();

	// Registro dos dados na sessão
		foreach($_POST as $chave => $valor) {
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);			
		}
	
	// Validacao dos dados

		if(strlen($_SESSION['senha']) == 0)
			$erro[] = "Preencha a senha.";


		if(strcmp($_SESSION['senha'],$_SESSION['rsenha']) != 0)
			$erro[] = "As senhas não combinam.";


	// Inserção no Banco e redirecionamento
		if (!isset($erro)) {
			
			$sql_code = "UPDATE tuser SET user_senha='$_SESSION[senha]' WHERE user_nome='$usuario[nome]'";
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);

			if($confirma){
				unset($_SESSION['senha']);

				echo "<script>location.href='index.php?codigo=1'; </script>";
			}else{
				$erro[]=$confirma;
			}

		}

	}






?>

<?php include_once("view/header.php"); ?>

	<body>
		

	<div id="iniciorodada">
		<div class="container" id="inicio-rodada">
			<div class="row">
				<div class="col-md-12">
					<h1>Alterar Senha</h1>
				</div>
			</div>
		</div>

	</div>


		<div id="erroPrimeiroAcesso" class="container">
			<div class="text-center">
				<?php 

					if(isset($erro) > 0)
					foreach ($erro as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>

		<div id="boasvindas" class="erro container">
			<div class="text-center">
				<?php 

					if(isset($boasvindas) > 0)
					foreach ($boasvindas as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>


		<div id="formPrimAcesso" class="container">
			<form method="POST">
				<div class="form-group">
					<label for="nome">Guerreiro(a)</label>
					<p><input class="form-control" name="nome" value="<?php echo $usuario['nome'] ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="senha">Nova senha</label>
					<p><input class="form-control" type="password" name="senha" value="" required></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="rsenha">Repetir Senha</label>
					<input class="form-control" name="rsenha" value="" required type="password">
				<p class=espaco></p>
				</div>
				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Confirmar</button></p>
				</div>
			</form>
		</div>

	</body>

	<script>
     	window.onload = function(){
     		$('#erroPrimeiroAcesso').fadeOut(5000);} 
	</script>


<?php include_once("view/footer.php"); ?>