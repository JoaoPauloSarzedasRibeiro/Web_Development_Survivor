<?php

	include("conexao/conexao.php");

	if(isset($erro)){
		unset($erro);
	}
	 
	// Carregando lista de usuários
	$sql_code_usuarios = "SELECT user_nome FROM tuser ORDER BY user_nome";
	$sql_query_usuarios = $mysqli->query($sql_code_usuarios) or die($mysqli->error);

	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==1 || $_GET['codigo']==2 || $_GET['codigo']==3) {
			$alerta[] = "Sessão expirada. Por favor faça o login novamente.";
		}
	}

	if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {
		
		if (!isset($_SESSION))
			session_start();
		
		$_SESSION['nome'] = $mysqli->escape_string($_POST['nome']);
		$_SESSION['senha'] = $_POST['senha'];

		$sql_code = "SELECT user_nome, user_senha, user_vida, user_id, prim_acesso, user_bolao FROM tuser WHERE user_nome = '$_SESSION[nome]'";
		$sql_query = $mysqli->query($sql_code) or die($mysqli->error);

		$dado = $sql_query->fetch_assoc();
		$total = $sql_query->num_rows;

		if ($total == 0) {
			$erro[] = "Ocorreu um erro, tente novamente!";
		}elseif($dado['user_vida']==0){
			$erro[] = "Fim de jogo!";
			echo "<script> location.href='fimdejogo.php'; </script>";
		}else{

			if ($dado['user_senha'] == $_SESSION['senha']) {
				$_SESSION['usuario'] = $dado['user_id'];
				$_SESSION['nome'] = $dado['user_nome'];
			}else{
				$erro[] = "Senha incorreta, tente novamente!";
			}
		}
	

		if(!isset($erro)){
			if ($dado['prim_acesso']==1) {
				$_SESSION['usuario'] = $dado['user_id'];
				$_SESSION['nome'] = $dado['user_nome'];
				echo "<script> location.href='primeiroacesso.php?codigo=0'; </script>";
			}else{
				if (isset($_GET['codigo'])) {
					if ($_GET['codigo']==1){
						$_SESSION['usuario'] = $dado['user_id'];
						$_SESSION['nome'] = $dado['user_nome'];
						echo "<script> location.href='fazerpalpite.php'; </script>";
					}elseif($_GET['codigo']==2){
						$_SESSION['usuario'] = $dado['user_id'];
						$_SESSION['nome'] = $dado['user_nome'];
						echo "<script> location.href='editarpalpite.php'; </script>";
					}elseif($_GET['codigo']==3){
						$_SESSION['usuario'] = $dado['user_id'];
						$_SESSION['nome'] = $dado['user_nome'];
						echo "<script> location.href='primeiroacesso.php'; </script>";
					}elseif($_GET['codigo']==11){
						$_SESSION['usuario'] = $dado['user_id'];
						$_SESSION['nome'] = $dado['user_nome'];
						echo "<script> location.href='guru.php'; </script>";
					}elseif($_GET['codigo']==100){
						if ($dado['user_bolao']==1) {
							$_SESSION['usuario'] = $dado['user_id'];
							$_SESSION['nome'] = $dado['user_nome'];
							echo "<script> location.href='bolao_fazerpalpite.php'; </script>";
						}else{
							echo "<script> alert('Você não possui acesso ao bolão! Fale com o adm.'); location.href='index.php'; </script>";
						}
					}
				}else{
					$_SESSION['usuario'] = $dado['user_id'];
					$_SESSION['nome'] = $dado['user_nome'];
					echo "<script> location.href='index.php?codigo=1'; </script>";
				}
				
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
						<h1>Login</h1>
					</div>
				</div>
			</div>

		</div>

		<div id="erro" class="erro container">
			<div class="text-center">
				<?php 

					if(isset($erro) > 0)
					foreach ($erro as $msg) {
						echo "<p>$msg</p>";
					}

					if(isset($alerta) > 0)
					foreach ($alerta as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>

		<div id="formLogin" class="container">
			<form method="POST">
				<div class="form-group">
					<label for="nome">Guerreiro(a)</label>
					<p><select class="form-control" name="nome">
						<?php while ($usuarios = $sql_query_usuarios->fetch_array()){ ?>
		         		 <option value="<?php echo $usuarios['user_nome']; ?>"><?php echo $usuarios['user_nome']; ?></option>
		     			<?php } ?>
		     		</select></p>
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<p><input class="form-control" type="password" name="senha"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Entrar</button></p>
				</div>
			</form>
		</div>





<?php include_once("view/footer.php"); ?>

	<script>
     	window.onload = function(){
     		$('#erro').fadeOut(5000);}

	</script>