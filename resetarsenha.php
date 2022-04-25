<?php 

	include("conexao/conexao.php");

	// Carregando lista de usuários
	$sql_code_usuarios = "SELECT user_nome FROM tuser ORDER BY user_nome";
	$sql_query_usuarios = $mysqli->query($sql_code_usuarios) or die($mysqli->error);

	
	// Criação da Sessão
	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			session_start();

	// Registro dos dados na sessão
		foreach($_POST as $chave => $valor) {
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);			
		}
	

	// Inserção no Banco e redirecionamento
		if (!isset($erro)) {
			
			$sql_code = "UPDATE tuser SET
								user_senha = 'senha123',
								prim_acesso = 1
							WHERE
								user_nome='$_SESSION[nome]'";
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);

			if($confirma){
				echo "<script>alert('Senha resetada com sucesso!'); location.href='adminadminadmin.php'; </script>";
			}else{
				$erro[]=$confirma;
			}

		}

	}
?>

<?php include_once("view/header.php"); ?>
	<body>


		<div id="erro" class="container">
			<div class="text-center">
				<?php 

					if(isset($erro) > 0)
					foreach ($erro as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>
	
	<div id="formCadastro" class="container">
		<form method="POST">
			<div class="form-group">
				<label for="nome">Guerreiro(a)</label>
				<p><select class="form-control" name="nome" id="nome">
					<?php while ($usuarios = $sql_query_usuarios->fetch_array()){ ?>
	         		 <option value="<?php echo $usuarios['user_nome']; ?>"><?php echo $usuarios['user_nome']; ?></option>
	     			<?php } ?>
	     		</select></p>
			</div>
			<div class="form-group">
				<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Resetar senha</button></p>
			</div>
			
		</form>
	</div>
	</body>


<?php include_once("view/footer.php"); ?>


	<script>
 	window.onload = function(){
 		$('#erro').fadeOut(5000);}

	</script>